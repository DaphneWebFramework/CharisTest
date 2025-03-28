<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Helper;

use \TestToolkit\AccessHelper;

#[CoversClass(Helper::class)]
class HelperTest extends TestCase
{
    /**
     * Normalizes a class list string by parsing and sorting the classes.
     *
     * @param string $classList
     *   The class list string to normalize.
     * @return string
     *   The normalized class list string with sorted classes.
     */
    private function normalizeClassAttribute(string $classList): string
    {
        $classes = AccessHelper::CallStaticMethod(
            Helper::class,
            'parseClassAttribute',
            [$classList]
        );
        \sort($classes);
        return \implode(' ', $classes);
    }

    #region MergeAttributes ----------------------------------------------------

    #[DataProvider('mergeAttributesDataProvider')]
    function testMergeAttributes(
        array $expected,
        ?array $userAttributes,
        array $defaultAttributes,
        array $mutuallyExclusiveClassGroups
    ) {
        $result = Helper::MergeAttributes(
            $userAttributes,
            $defaultAttributes,
            $mutuallyExclusiveClassGroups
        );
        if (\array_key_exists('class', $expected)) {
            $expected['class'] = $this->normalizeClassAttribute($expected['class']);
        }
        if (\array_key_exists('class', $result)) {
            $result['class'] = $this->normalizeClassAttribute($result['class']);
        }
        $this->assertSame($expected, $result);
    }

    #endregion MergeAttributes

    #region CombineClassAttributes ---------------------------------------------

    #[DataProvider('combineClassAttributesDataProvider')]
    function testCombineClassAttributes(
        string $expected,
        string $classes1,
        string $classes2
    ) {
        $result = Helper::CombineClassAttributes($classes1, $classes2);
        $expected = $this->normalizeClassAttribute($expected);
        $result = $this->normalizeClassAttribute($result);
        $this->assertSame($expected, $result);
    }

    #endregion CombineClassAttributes

    #region ConsumePseudoAttribute ---------------------------------------------

    #[DataProvider('consumePseudoAttributeDataProvider')]
    function testConsumePseudoAttribute(
        mixed $expected,
        array $attributes,
        string $key,
        mixed $defaultValue
    ) {
        $result = Helper::ConsumePseudoAttribute($attributes, $key, $defaultValue);
        $this->assertSame($expected, $result);
    }

    function testConsumePseudoAttributeRemovesAttribute(): void
    {
        $attributes = [':pseudo' => 'value', 'other' => 'value2'];
        Helper::ConsumePseudoAttribute($attributes, ':pseudo');
        $this->assertSame(['other' => 'value2'], $attributes);
    }

    #endregion ConsumePseudoAttribute

    #region parseClassAttribute ------------------------------------------------

    #[DataProvider('parseClassAttributeDataProvider')]
    function testParseClassAttribute(
        array $expected,
        string $classList
    ) {
        $result = AccessHelper::CallStaticMethod(
            Helper::class,
            'parseClassAttribute',
            [$classList]
        );
        $this->assertSame($expected, $result);
    }

    #endregion parseClassAttribute

    #region resolveClassAttributes ---------------------------------------------

    #[DataProvider('resolveClassAttributesDataProvider')]
    function testResolveClassAttributes(
        string $expected,
        string $defaultClasses,
        string $userClasses,
        array $mutuallyExclusiveClassGroups
    ) {
        $result = AccessHelper::CallStaticMethod(
            Helper::class,
            'resolveClassAttributes',
            [$defaultClasses, $userClasses, $mutuallyExclusiveClassGroups]
        );
        $expected = $this->normalizeClassAttribute($expected);
        $result = $this->normalizeClassAttribute($result);
        $this->assertSame($expected, $result);
    }

    #endregion resolveClassAttributes

    #region Data Providers -----------------------------------------------------

    static function mergeAttributesDataProvider()
    {
        return [
            'no user attributes' => [
                ['type' => 'button', 'class' => 'btn'],
                null,
                ['type' => 'button', 'class' => 'btn'],
                []
            ],
            'user overrides' => [
                ['type' => 'submit', 'class' => 'btn btn-primary'],
                ['type' => 'submit', 'class' => 'btn-primary'],
                ['type' => 'button', 'class' => 'btn'],
                []
            ],
            'additional attributes' => [
                ['type' => 'button', 'class' => 'btn btn-primary', 'id' => 'testButton'],
                ['id' => 'testButton', 'class' => 'btn-primary'],
                ['type' => 'button', 'class' => 'btn'],
                []
            ],
            'no class attribute' => [
                ['type' => 'button', 'id' => 'testButton'],
                ['id' => 'testButton'],
                ['type' => 'button'],
                []
            ],
            'mutual exclusions' => [
                ['type' => 'button', 'class' => 'btn btn-secondary'],
                ['class' => 'btn-secondary'],
                ['type' => 'button', 'class' => 'btn btn-primary'],
                ['btn-primary btn-secondary']
            ],
        ];
    }

    static function combineClassAttributesDataProvider()
    {
        return [
            'no duplicates' => [
                'btn btn-primary',
                'btn',
                'btn-primary'
            ],
            'with duplicates' => [
                'btn btn-primary',
                'btn btn-primary',
                'btn btn-primary'
            ],
            'empty strings' => [
                '',
                '',
                ''
            ],
            'extra spaces' => [
                'btn btn-primary',
                '  btn  ',
                '  btn-primary  '
            ],
        ];
    }

    static function consumePseudoAttributeDataProvider()
    {
        return [
            'valid pseudo attribute' => [
                'value',
                [':pseudo' => 'value', 'other' => 'value2'],
                ':pseudo',
                null
            ],
            'pseudo attribute not found' => [
                null,
                ['other' => 'value2'],
                ':nonexistent',
                null
            ],
            'invalid pseudo attribute key' => [
                null,
                [':pseudo' => 'value', 'other' => 'value2'],
                'invalid-key',
                null
            ],
            'default value used' => [
                'default',
                ['other' => 'value2'],
                ':pseudo',
                'default'
            ],
            'case-sensitive match' => [
                null,
                [':Pseudo' => 'value'],
                ':pseudo',
                null
            ],
        ];
    }

    static function parseClassAttributeDataProvider()
    {
        return [
            'simple list' => [
                ['btn', 'btn-primary'],
                'btn btn-primary'
            ],
            'extra spaces' => [
                ['btn', 'btn-primary'],
                '  btn   btn-primary  '
            ],
            'whitespace-only string' => [
                [],
                '     '
            ],
            'empty string' => [
                [],
                ''
            ],
        ];
    }

    static function resolveClassAttributesDataProvider()
    {
        return [
        // Basic Functionality
            'default classes only, no user classes' => [
                'btn btn-default',
                'btn btn-default',
                '',
                []
            ],
            'user classes only, no default classes' => [
                'btn btn-primary',
                '',
                'btn btn-primary',
                []
            ],
            'user and default classes' => [
                'class1 class2 class3',
                'class1',
                'class2 class3',
                []
            ],
        // Duplicate Handling
            'duplicates within default classes' => [
                'class1 class2',
                'class1 class2 class1',
                '',
                []
            ],
            'duplicates within user classes' => [
                'class1 class2',
                '',
                'class1 class2 class1',
                []
            ],
            'duplicates between user and default classes' => [
                'btn btn-primary',
                'btn btn-primary',
                'btn btn-primary',
                []
            ],
        // Conflict Resolution
            'user class overrides default in mutually exclusive group' => [
                'btn btn-primary',
                'btn btn-default',
                'btn-primary',
                ['btn-default btn-primary btn-success']
            ],
            'multiple conflicts across different groups resolved in favor of user classes' => [
                'btn btn-primary btn-lg',
                'btn btn-default btn-sm',
                'btn-primary btn-lg',
                ['btn-default btn-primary btn-success', 'btn-sm btn-lg']
            ],
            'user and default specify multiple conflicting classes from same group' => [
                'btn btn-primary',
                'btn btn-default btn-success',
                'btn-primary btn-success',
                ['btn-default btn-primary btn-success']
            ],
            'user specifies multiple conflicting classes from same group' => [
                'btn btn-primary',
                'btn',
                'btn-primary btn-success',
                ['btn-default btn-primary btn-success']
            ],
            'default specifies multiple conflicting classes from same group' => [
                'btn',
                'btn btn-default btn-success',
                '',
                ['btn-default btn-primary btn-success']
            ],
            'user and default specify same class from mutually exclusive group' => [
                'btn btn-primary',
                'btn btn-primary',
                'btn-primary',
                ['btn-default btn-primary btn-success']
            ],
            'user class not in mutually exclusive group is added' => [
                'btn btn-default custom-class',
                'btn btn-default',
                'custom-class',
                ['btn-default btn-primary btn-success']
            ],
        // Empty and Whitespace
            'inputs with extra spaces and tabs' => [
                'btn btn-primary btn-lg',
                "  btn\tbtn-default  ",
                "\tbtn-primary  btn-lg  ",
                ["  btn-default\tbtn-primary  ", "  btn-sm  btn-lg  "]
            ],
            'empty strings' => [
                '',
                '',
                '',
                ['']
            ],
        // Edge Cases
            'mutually exclusive group not present in classes' => [
                'btn btn-default',
                'btn btn-default',
                '',
                ['btn-success btn-warning']
            ],
            'empty mutually exclusive groups' => [
                'btn btn-default btn-primary',
                'btn btn-default',
                'btn-primary',
                ['', '   ']
            ],
            'large number of classes' => [
                'class1 class2 class3 class4 class5 class6 class7 class8 class9 class10',
                'class1 class2 class3 class4 class5',
                'class6 class7 class8 class9 class10',
                []
            ],
            'classes with international characters' => [
                'btn btn-ñ btn-ç',
                'btn',
                'btn-ñ btn-ç',
                []
            ],
            'case sensitive classes' => [
                'btn btn-default btn-primary',
                'btn btn-default',
                'btn-primary',
                ['btn-default Btn-primary btn-success']
            ],
        ];
    }

    #endregion Data Providers
}
