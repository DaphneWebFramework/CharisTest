<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\ComponentHelper;

use \TestToolkit\AccessHelper;

#[CoversClass(ComponentHelper::class)]
class ComponentHelperTest extends TestCase
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
        $classes = AccessHelper::CallNonPublicStaticMethod(
            ComponentHelper::class,
            'parseClassAttribute',
            [$classList]
        );
        \sort($classes);
        return \implode(' ', $classes);
    }

    #region MergeAttributes ----------------------------------------------------

    #[DataProvider('mergeAttributesDataProvider')]
    function testMergeAttributes($expected, $defaultAttributes,
        $userAttributes = null, $mutuallyExclusiveClassGroups = [])
    {
        $result = ComponentHelper::MergeAttributes(
            $defaultAttributes,
            $userAttributes,
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
    function testCombineClassAttributes($expected, $classes1, $classes2)
    {
        $result = ComponentHelper::CombineClassAttributes($classes1, $classes2);
        $expected = $this->normalizeClassAttribute($expected);
        $result = $this->normalizeClassAttribute($result);
        $this->assertSame($expected, $result);
    }

    #endregion CombineClassAttributes

    #region ConsumePseudoAttribute ---------------------------------------------

    #[DataProvider('consumePseudoAttributeDataProvider')]
    function testConsumePseudoAttribute($expected, $attributes, $key, $default = null)
    {
        $result = ComponentHelper::ConsumePseudoAttribute($attributes, $key, $default);
        $this->assertSame($expected, $result);
    }

    function testConsumePseudoAttributeRemovesAttribute(): void
    {
        $attributes = [':pseudo' => 'value', 'other' => 'value2'];
        ComponentHelper::ConsumePseudoAttribute($attributes, ':pseudo');
        $this->assertSame(['other' => 'value2'], $attributes);
    }

    #endregion ConsumePseudoAttribute

    #region parseClassAttribute ------------------------------------------------

    #[DataProvider('parseClassAttributeDataProvider')]
    function testParseClassAttribute($expected, $classList)
    {
        $result = AccessHelper::CallNonPublicStaticMethod(
            ComponentHelper::class,
            'parseClassAttribute',
            [$classList]
        );
        $this->assertSame($expected, $result);
    }

    #endregion parseClassAttribute

    #region resolveClassAttributes ---------------------------------------------

    #[DataProvider('resolveClassAttributesDataProvider')]
    function testResolveClassAttributes($expected, $defaultClasses, $userClasses,
        $mutuallyExclusiveClassGroups = [])
    {
        $result = AccessHelper::CallNonPublicStaticMethod(
            ComponentHelper::class,
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
                ['type' => 'button', 'class' => 'btn']
            ],
            'user overrides' => [
                ['type' => 'submit', 'class' => 'btn btn-primary'],
                ['type' => 'button', 'class' => 'btn'],
                ['type' => 'submit', 'class' => 'btn-primary']
            ],
            'additional attributes' => [
                ['type' => 'button', 'class' => 'btn btn-primary', 'id' => 'testButton'],
                ['type' => 'button', 'class' => 'btn'],
                ['id' => 'testButton', 'class' => 'btn-primary']
            ],
            'no class attribute' => [
                ['type' => 'button', 'id' => 'testButton'],
                ['type' => 'button'],
                ['id' => 'testButton']
            ],
            'mutual exclusions' => [
                ['type' => 'button', 'class' => 'btn btn-secondary'],
                ['type' => 'button', 'class' => 'btn btn-primary'],
                ['class' => 'btn-secondary'],
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
                ':pseudo'
            ],
            'pseudo attribute not found' => [
                null,
                ['other' => 'value2'],
                ':nonexistent'
            ],
            'invalid pseudo attribute key' => [
                null,
                [':pseudo' => 'value', 'other' => 'value2'],
                'invalid-key'
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
                ':pseudo'
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
                ''
            ],
            'user classes only, no default classes' => [
                'btn btn-primary',
                '',
                'btn btn-primary'
            ],
            'user and default classes' => [
                'class1 class2 class3',
                'class1',
                'class2 class3'
            ],
        // Duplicate Handling
            'duplicates within default classes' => [
                'class1 class2',
                'class1 class2 class1',
                ''
            ],
            'duplicates within user classes' => [
                'class1 class2',
                '',
                'class1 class2 class1'
            ],
            'duplicates between user and default classes' => [
                'btn btn-primary',
                'btn btn-primary',
                'btn btn-primary'
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
            'case sentsitive classes' => [
                'btn btn-default btn-primary',
                'btn btn-default',
                'btn-primary',
                ['btn-default Btn-primary btn-success']
            ],
        ];
    }

    #endregion Data Providers
}
