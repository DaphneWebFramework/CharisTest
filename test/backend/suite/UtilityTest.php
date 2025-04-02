<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Utility;

use \TestToolkit\AccessHelper;

class UtilityHost { use Utility; }

class UtilityTest extends TestCase
{
    private ?UtilityHost $sut = null;

    protected function setUp(): void
    {
        $this->sut = new UtilityHost();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    // private function systemUnderTest(string ...$mockedMethods): UtilityHost
    // {
    //     return $this->getMockBuilder(UtilityHost::class)
    //         ->onlyMethods($mockedMethods)
    //         ->getMock();
    // }

    private function sortClasses(string $classes): string
    {
        if (!\is_string($classes)) {
            return $classes;
        }
        $classes = AccessHelper::CallMethod(
            $this->sut,
            'parseClassAttribute',
            [$classes]
        );
        \sort($classes);
        return \implode(' ', $classes);
    }

    #region mergeAttributes ----------------------------------------------------

    #[DataProvider('mergeAttributesDataProvider')]
    function testMergeAttributes(
        array $expected,
        ?array $userAttributes,
        array $defaultAttributes,
        array $mutuallyExclusiveClassGroups
    ) {
        $result = AccessHelper::CallMethod(
            $this->sut,
            'mergeAttributes',
            [$userAttributes, $defaultAttributes, $mutuallyExclusiveClassGroups]
        );
        if (\array_key_exists('class', $expected)) {
            if (\is_string($expected['class'])) {
                $expected['class'] = $this->sortClasses($expected['class']);
            }
        }
        if (\array_key_exists('class', $result)) {
            if (\is_string($result['class'])) {
                $result['class'] = $this->sortClasses($result['class']);
            }
        }
        $this->assertSame($expected, $result);
    }

    #endregion mergeAttributes

    #region combineClassAttributes ---------------------------------------------

    #[DataProvider('combineClassAttributesDataProvider')]
    function testCombineClassAttributes(
        string $expected,
        string $classes1,
        string $classes2
    ) {
        $result = AccessHelper::CallMethod(
            $this->sut,
            'combineClassAttributes',
            [$classes1, $classes2]
        );
        $this->assertSame(
            $this->sortClasses($expected),
            $this->sortClasses($result)
        );
    }

    #endregion combineClassAttributes

    #region consumePseudoAttribute ---------------------------------------------

    #[DataProvider('consumePseudoAttributeDataProvider')]
    function testConsumePseudoAttribute(
        mixed $expected,
        ?array $attributes,
        string $key,
        mixed $defaultValue
    ) {
        $this->assertSame(
            $expected,
            AccessHelper::CallMethod(
                $this->sut,
                'consumePseudoAttribute',
                [&$attributes, $key, $defaultValue]
            )
        );
    }

    function testConsumePseudoAttributeRemovesAttribute(): void
    {
        $attributes = [':pseudo' => 'value', 'other' => 'value2'];
        AccessHelper::CallMethod(
            $this->sut,
            'consumePseudoAttribute',
            [&$attributes, ':pseudo']
        );
        $this->assertSame(['other' => 'value2'], $attributes);
    }

    #endregion consumePseudoAttribute

    #region isResolvableClassAttribute -----------------------------------------

    #[DataProvider('isResolvableClassAttributeDataProvider')]
    function testIsResolvableClassAttribute(bool $expected, mixed $value)
    {
        $this->assertSame(
            $expected,
            AccessHelper::CallMethod(
                $this->sut,
                'isResolvableClassAttribute',
                [$value]
            )
        );
    }

    #endregion isResolvableClassAttribute

    #region filterNegativeClassDirectives --------------------------------------

    #[DataProvider('filterNegativeClassDirectivesDataProvider')]
    function testFilterNegativeClassDirectives(
        string $expectedUserClasses,
        string $expectedDefaultClasses,
        string $userClasses,
        string $defaultClasses
    ) {
        [$actualUserClasses, $actualDefaultClasses] = AccessHelper::CallMethod(
            $this->sut,
            'filterNegativeClassDirectives',
            [$userClasses, $defaultClasses]
        );
        $this->assertSame(
            $this->sortClasses($expectedUserClasses),
            $this->sortClasses($actualUserClasses)
        );
        $this->assertSame(
            $this->sortClasses($expectedDefaultClasses),
            $this->sortClasses($actualDefaultClasses)
        );
    }

    #endregion filterNegativeClassDirectives

    #region resolveClassAttributes ---------------------------------------------

    #[DataProvider('resolveClassAttributesDataProvider')]
    function testResolveClassAttributes(
        string $expected,
        string $userClasses,
        string $defaultClasses,
        array $mutuallyExclusiveClassGroups
    ) {
        $result = AccessHelper::CallMethod(
            $this->sut,
            'resolveClassAttributes',
            [$userClasses, $defaultClasses, $mutuallyExclusiveClassGroups]
        );
        $this->assertSame(
            $this->sortClasses($expected),
            $this->sortClasses($result)
        );
    }

    #endregion resolveClassAttributes

    #region parseClassAttribute ------------------------------------------------

    #[DataProvider('parseClassAttributeDataProvider')]
    function testParseClassAttribute(
        array $expected,
        string $classes
    ) {
        $this->assertSame(
            $expected,
            AccessHelper::CallMethod(
                $this->sut,
                'parseClassAttribute',
                [$classes]
            )
        );
    }

    #endregion parseClassAttribute

    #region Data Providers -----------------------------------------------------

    static function mergeAttributesDataProvider()
    {
        // expected
        // userAttributes
        // defaultAttributes
        // mutuallyExclusiveClassGroups
        return [
            'no user attributes' => [
                ['type' => 'button', 'class' => 'btn'],
                null,
                ['type' => 'button', 'class' => 'btn'],
                []
            ],
            'user overrides type attribute' => [
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
            //-- user: string --------------------------------------------------
            'user class is string, default class is string' => [
                ['class' => 'cls cls-user'],
                ['class' => 'cls-user'],
                ['class' => 'cls'],
                []
            ],
            'user class is string, default class is stringable' => [
                ['class' => 'cls cls-user'],
                ['class' => 'cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is string, default class is integer' => [
                ['class' => '123 cls-user'],
                ['class' => 'cls-user'],
                ['class' => 123],
                []
            ],
            'user class is string, default class is float' => [
                ['class' => '123.45 cls-user'],
                ['class' => 'cls-user'],
                ['class' => 123.45],
                []
            ],
            'user class is string, default class is true' => [
                ['class' => 'cls-user'],
                ['class' => 'cls-user'],
                ['class' => true],
                []
            ],
            'user class is string, default class is false' => [
                ['class' => 'cls-user'],
                ['class' => 'cls-user'],
                ['class' => false],
                []
            ],

            //-- user: stringable ----------------------------------------------
            'user class is stringable, default class is string' => [
                ['class' => 'cls cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => 'cls'],
                []
            ],
            'user class is stringable, default class is stringable' => [
                ['class' => 'cls cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is stringable, default class is integer' => [
                ['class' => '123 cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => 123],
                []
            ],
            'user class is stringable, default class is float' => [
                ['class' => '123.45 cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => 123.45],
                []
            ],
            'user class is stringable, default class is true' => [
                ['class' => 'cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => true],
                []
            ],
            'user class is stringable, default class is false' => [
                ['class' => 'cls-user'],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls-user';
                    }
                }],
                ['class' => false],
                []
            ],
            //-- user: integer -------------------------------------------------
            'user class is integer, default class is string' => [
                ['class' => 'cls 456'],
                ['class' => 456],
                ['class' => 'cls'],
                []
            ],
            'user class is integer, default class is stringable' => [
                ['class' => 'cls 456'],
                ['class' => 456],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is integer, default class is integer' => [
                ['class' => '123 456'],
                ['class' => 456],
                ['class' => 123],
                []
            ],
            'user class is integer, default class is float' => [
                ['class' => '123.45 456'],
                ['class' => 456],
                ['class' => 123.45],
                []
            ],
            'user class is integer, default class is true' => [
                ['class' => '456'],
                ['class' => 456],
                ['class' => true],
                []
            ],
            'user class is integer, default class is false' => [
                ['class' => '456'],
                ['class' => 456],
                ['class' => false],
                []
            ],

            //-- user: float ---------------------------------------------------
            'user class is float, default class is string' => [
                ['class' => 'cls 456.78'],
                ['class' => 456.78],
                ['class' => 'cls'],
                []
            ],
            'user class is float, default class is stringable' => [
                ['class' => 'cls 456.78'],
                ['class' => 456.78],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is float, default class is integer' => [
                ['class' => '123 456.78'],
                ['class' => 456.78],
                ['class' => 123],
                []
            ],
            'user class is float, default class is float' => [
                ['class' => '123.45 456.78'],
                ['class' => 456.78],
                ['class' => 123.45],
                []
            ],
            'user class is float, default class is true' => [
                ['class' => '456.78'],
                ['class' => 456.78],
                ['class' => true],
                []
            ],
            'user class is float, default class is false' => [
                ['class' => '456.78'],
                ['class' => 456.78],
                ['class' => false],
                []
            ],

            //-- user: true ----------------------------------------------------
            'user class is true, default class is string' => [
                ['class' => true],
                ['class' => true],
                ['class' => 'cls'],
                []
            ],
            'user class is true, default class is stringable' => [
                ['class' => true],
                ['class' => true],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is true, default class is integer' => [
                ['class' => true],
                ['class' => true],
                ['class' => 123],
                []
            ],
            'user class is true, default class is float' => [
                ['class' => true],
                ['class' => true],
                ['class' => 123.45],
                []
            ],
            'user class is true, default class is true' => [
                ['class' => true],
                ['class' => true],
                ['class' => true],
                []
            ],
            'user class is true, default class is false' => [
                ['class' => true],
                ['class' => true],
                ['class' => false],
                []
            ],
            //-- user: false ---------------------------------------------------
            'user class is false, default class is string' => [
                ['class' => false],
                ['class' => false],
                ['class' => 'cls'],
                []
            ],
            'user class is false, default class is stringable' => [
                ['class' => false],
                ['class' => false],
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'user class is false, default class is integer' => [
                ['class' => false],
                ['class' => false],
                ['class' => 123],
                []
            ],
            'user class is false, default class is float' => [
                ['class' => false],
                ['class' => false],
                ['class' => 123.45],
                []
            ],
            'user class is false, default class is true' => [
                ['class' => false],
                ['class' => false],
                ['class' => true],
                []
            ],
            'user class is false, default class is false' => [
                ['class' => false],
                ['class' => false],
                ['class' => false],
                []
            ],
            //-- user: null ----------------------------------------------------
            'no user attributes, default class is string' => [
                ['class' => 'cls'],
                null,
                ['class' => 'cls'],
                []
            ],
            'no user attributes, default class is stringable' => [
                ['class' => 'cls'],
                null,
                ['class' => new class implements \Stringable {
                    public function __toString(): string {
                        return 'cls';
                    }
                }],
                []
            ],
            'no user attributes, default class is integer' => [
                ['class' => '123'],
                null,
                ['class' => 123],
                []
            ],
            'no user attributes, default class is float' => [
                ['class' => '123.45'],
                null,
                ['class' => 123.45],
                []
            ],
            'no user attributes, default is true' => [
                ['class' => true],
                null,
                ['class' => true],
                []
            ],
            'no user attributes, default is false' => [
                ['class' => false],
                null,
                ['class' => false],
                []
            ],
            //-- negative cases ------------------------------------------------
            'user replaces a default context class with a different one' => [
                ['class' => 'btn btn-orange'],
                ['class' => 'btn-orange -btn-primary'],
                ['class' => 'btn btn-primary'],
                ['btn-primary btn-secondary']
            ],
            'user replaces all defaults with new ones' => [
                ['class' => 'button-base shadow-md text-brand'],
                ['class' => '-btn -btn-primary button-base shadow-md text-brand'],
                ['class' => 'btn btn-primary'],
                ['btn-primary btn-secondary']
            ],
        ];
    }

    static function combineClassAttributesDataProvider()
    {
        // expected
        // classes1
        // classes2
        return [
            'empty strings' => [
                '',
                '',
                ''
            ],
            'whitespace-only strings' => [
                '',
                '     ',
                '     '
            ],
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
            'extra spaces' => [
                'btn btn-primary',
                '  btn  ',
                '  btn-primary  '
            ],
        ];
    }

    static function consumePseudoAttributeDataProvider()
    {
        // expected
        // attributes
        // key
        // defaultValue
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
            'empty attributes' => [
                null,
                [],
                ':pseudo',
                null
            ],
            'null attributes' => [
                null,
                null,
                ':pseudo',
                null
            ],
        ];
    }

    static function isResolvableClassAttributeDataProvider()
    {
        // expected
        // value
        return [
            [true, 'some-class'],
            [true, new class implements \Stringable {
                public function __toString(): string {
                    return 'some-class';
                }
            }],
            [true, 123],
            [true, 123.45],
            [false, true],
            [false, false],
            [false, null],
            [false, ['not', 'resolvable']],
            [false, new \stdClass()],
            [false, \fopen('php://memory', 'r')],
        ];
    }

    static function filterNegativeClassDirectivesDataProvider()
    {
        // expectedUserClasses
        // expectedDefaultClasses
        // userClasses
        // defaultClasses
        return [
            'no negation' => [
                'btn-primary',
                'btn',
                'btn-primary',
                'btn'
            ],
            'remove one' => [
                '',
                '',
                '-btn',
                'btn'
            ],
            'remove multiple' => [
                '',
                '',
                '-btn -btn-primary',
                'btn btn-primary'
            ],
            'remove multiple, different order' => [
                '',
                '',
                '-btn-primary -btn',
                'btn btn-primary'
            ],
            'remove one, add one' => [
                'btn-success',
                'btn',
                'btn-success -btn-primary',
                'btn btn-primary'
            ],
            'remove nonexistent' => [
                '',
                'btn btn-primary',
                '-nonexistent',
                'btn btn-primary'
            ],
            'remove with extra spaces' => [
                '',
                '',
                "  -btn\t  -btn-primary ",
                'btn btn-primary'
            ],
            'remove fails due to case sensitivity' => [
                '',
                'Btn',
                '-btn',
                'Btn'
            ],
        ];
    }

    static function resolveClassAttributesDataProvider()
    {
        // expected
        // userClasses
        // defaultClasses
        // mutuallyExclusiveClassGroups
        return [
        // Basic Functionality
            'default classes only, no user classes' => [
                'btn btn-default',
                '',
                'btn btn-default',
                []
            ],
            'user classes only, no default classes' => [
                'btn btn-primary',
                'btn btn-primary',
                '',
                []
            ],
            'user and default classes' => [
                'class1 class2 class3',
                'class2 class3',
                'class1',
                []
            ],
        // Duplicate Handling
            'duplicates within default classes' => [
                'class1 class2',
                '',
                'class1 class2 class1',
                []
            ],
            'duplicates within user classes' => [
                'class1 class2',
                'class1 class2 class1',
                '',
                []
            ],
            'duplicates between user and default classes' => [
                'btn btn-primary',
                'btn btn-primary',
                'btn btn-primary',
                []
            ],
        // Conflict Resolution
            'user overrides default, mutually exclusive group resolves to user' => [
                'btn btn-primary',
                'btn-primary',
                'btn btn-default',
                ['btn-default btn-primary btn-success']
            ],
            'multiple conflicts exist across groups, user classes are favored' => [
                'btn btn-primary btn-lg',
                'btn-primary btn-lg',
                'btn btn-default btn-sm',
                ['btn-default btn-primary btn-success', 'btn-sm btn-lg']
            ],
            'user and default both conflict in same group, user class is retained' => [
                'btn btn-primary',
                'btn-primary btn-success',
                'btn btn-default btn-success',
                ['btn-default btn-primary btn-success']
            ],
            'user provides multiple conflicting classes, only one is retained' => [
                'btn btn-primary',
                'btn-primary btn-success',
                'btn',
                ['btn-default btn-primary btn-success']
            ],
            'default provides multiple conflicting classes, only one is retained' => [
                'btn',
                '',
                'btn btn-default btn-success',
                ['btn-default btn-primary btn-success']
            ],
            'user and default specify the same class, no conflict' => [
                'btn btn-primary',
                'btn-primary',
                'btn btn-primary',
                ['btn-default btn-primary btn-success']
            ],
            'user class is outside mutually exclusive groups, it is added' => [
                'btn btn-default custom-class',
                'custom-class',
                'btn btn-default',
                ['btn-default btn-primary btn-success']
            ],
        // Empty and Whitespace
            'inputs with extra spaces and tabs' => [
                'btn btn-primary btn-lg',
                "\tbtn-primary  btn-lg  ",
                "  btn\tbtn-default  ",
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
                '',
                'btn btn-default',
                ['btn-success btn-warning']
            ],
            'empty mutually exclusive groups' => [
                'btn btn-default btn-primary',
                'btn-primary',
                'btn btn-default',
                ['', '   ']
            ],
            'large number of classes' => [
                'class1 class2 class3 class4 class5 class6 class7 class8 class9 class10',
                'class6 class7 class8 class9 class10',
                'class1 class2 class3 class4 class5',
                []
            ],
            'classes with international characters' => [
                'btn btn-ñ btn-ç',
                'btn-ñ btn-ç',
                'btn',
                []
            ],
            'case sensitive classes' => [
                'btn btn-default btn-primary',
                'btn-primary',
                'btn btn-default',
                ['btn-default Btn-primary btn-success']
            ],
        ];
    }

    static function parseClassAttributeDataProvider()
    {
        // expected
        // classes
        return [
            'empty string' => [
                [],
                ''
            ],
            'whitespace-only string' => [
                [],
                '     '
            ],
            'single class' => [
                ['btn'],
                'btn'
            ],
            'single class with whitespace' => [
                ['btn'],
                '  btn  '
            ],
            'multiple classes' => [
                ['btn', 'btn-primary'],
                'btn btn-primary'
            ],
            'multiple classes with whitespace' => [
                ['btn', 'btn-primary'],
                '  btn   btn-primary  '
            ],
        ];
    }

    #endregion Data Providers
}
