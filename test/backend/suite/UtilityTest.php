<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Utility;

use \TestToolkit\AccessHelper;

class _Utility { use Utility; }

class UtilityTest extends TestCase
{
    private ?_Utility $sut = null;

    protected function setUp(): void
    {
        $this->sut = new _Utility();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    /**
     * Alternative method for constructing the system under test, allowing for
     * mocking of specific methods.
     */
    private function systemUnderTest(string ...$mockedMethods): _Utility
    {
        return $this->getMockBuilder(_Utility::class)
            ->onlyMethods($mockedMethods)
            ->getMock();
    }

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

    function testMergeAttributesWithMutuallyExclusiveGroups()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                ['btn-primary', true],
                ['btn-secondary', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('btn-primary', 'btn-secondary')
            ->willReturn(['btn-primary', 'btn-secondary']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('btn-primary',
                   'btn-secondary',
                   ['btn-primary btn-secondary btn-success'])
            ->willReturn('btn-primary');

        $this->assertSame(
            ['class' => 'btn-primary'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => 'btn-primary'],
                    ['class' => 'btn-secondary'],
                    ['btn-primary btn-secondary btn-success']
                ]
            )
        );
    }

    function testMergeAttributesWithClassFalseSkipsResolution()
    {
        $sut = $this->systemUnderTest(
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->never())
            ->method('filterNegativeClassDirectives');
        $sut->expects($this->never())
            ->method('resolveClassAttributes');

        $this->assertSame(
            ['class' => false],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => false],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithClassTruePreservesValue()
    {
        $sut = $this->systemUnderTest(
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->never())
            ->method('filterNegativeClassDirectives');
        $sut->expects($this->never())
            ->method('resolveClassAttributes');

        $this->assertSame(
            ['class' => true],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => true],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithOnlyDefaultClassResolvable()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                [null, false],
                ['btn', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('', 'btn')
            ->willReturn(['', 'btn']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('', 'btn', [])
            ->willReturn('btn');

        $this->assertSame(
            ['class' => 'btn'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    [],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithNullUserAttributes()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                [null, false],
                ['btn', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('', 'btn')
            ->willReturn(['', 'btn']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('', 'btn', [])
            ->willReturn('btn');

        $this->assertSame(
            ['class' => 'btn'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    null,
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithUnresolvableUserClass()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                [[], false],
                ['btn', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('', 'btn')
            ->willReturn(['', 'btn']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('', 'btn', [])
            ->willReturn('btn');

        $this->assertSame(
            ['class' => 'btn'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => []],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithBothClassesUnresolvable()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                [[], false],
                [null, false]
            ]);
        $sut->expects($this->never())
            ->method('filterNegativeClassDirectives');
        $sut->expects($this->never())
            ->method('resolveClassAttributes');

        $this->assertSame(
            ['class' => []],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => []],
                    ['class' => null],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithNegativeClassDirective()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->with($this->anything())
            ->willReturnMap([
                ['-btn-large btn-small', true],
                ['btn-large', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('-btn-large btn-small', 'btn-large')
            ->willReturn(['btn-small', '']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('btn-small', '', [])
            ->willReturn('btn-small');

        $this->assertSame(
            ['class' => 'btn-small'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => '-btn-large btn-small'],
                    ['class' => 'btn-large'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithIdenticalClass()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->with($this->anything())
            ->willReturnMap([
                ['btn', true],
                ['btn', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('btn', 'btn')
            ->willReturn(['btn', 'btn']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('btn', 'btn', [])
            ->willReturn('btn');

        $this->assertSame(
            ['class' => 'btn'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => 'btn'],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithEmptyUserClass()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->exactly(2))
            ->method('isResolvableClassAttribute')
            ->willReturnMap([
                ['', true],
                ['btn', true]
            ]);
        $sut->expects($this->once())
            ->method('filterNegativeClassDirectives')
            ->with('', 'btn')
            ->willReturn(['', 'btn']);
        $sut->expects($this->once())
            ->method('resolveClassAttributes')
            ->with('', 'btn', [])
            ->willReturn('btn');

        $this->assertSame(
            ['class' => 'btn'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['class' => ''],
                    ['class' => 'btn'],
                    []
                ]
            )
        );
    }

    function testMergeAttributesWithNonClassAttributes()
    {
        $sut = $this->systemUnderTest(
            'isResolvableClassAttribute',
            'filterNegativeClassDirectives',
            'resolveClassAttributes'
        );

        $sut->expects($this->never())
            ->method('isResolvableClassAttribute');
        $sut->expects($this->never())
            ->method('filterNegativeClassDirectives');
        $sut->expects($this->never())
            ->method('resolveClassAttributes');

        $this->assertSame(
            ['style' => 'color:red', 'id' => 'myId'],
            AccessHelper::CallMethod(
                $sut,
                'mergeAttributes',
                [
                    ['id' => 'myId'],
                    ['style' => 'color:red'],
                    []
                ]
            )
        );
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

    function testConsumePseudoAttributeRemovesAttribute()
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

    #region consumeScopedPseudoAttributes --------------------------------------

    #[DataProvider('consumeScopedPseudoAttributesDataProvider')]
    function testConsumeScopedPseudoAttributes(
        ?array $attributes,
        string $scope,
        array $expectedResult,
        ?array $expectedRemaining
    ) {
        $result = AccessHelper::CallMethod(
            $this->sut,
            'consumeScopedPseudoAttributes',
            [&$attributes, $scope]
        );
        $this->assertSame($expectedResult, $result);
        $this->assertSame($expectedRemaining, $attributes);
    }

    #endregion consumeScopedPseudoAttributes

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
            'no user attributes, default class retained' => [
                ['class' => 'btn'],
                null,
                ['class' => 'btn'],
                []
            ],
            'user class is true, default class removed' => [
                ['class' => true],
                ['class' => true],
                ['class' => 'btn'],
                []
            ],
            'user class is false, default class removed' => [
                ['class' => false],
                ['class' => false],
                ['class' => 'btn'],
                []
            ],
            'basic class merge, no exclusivity' => [
                ['class' => 'btn btn-primary'],
                ['class' => 'btn-primary'],
                ['class' => 'btn'],
                []
            ],
            'class resolved by mutually exclusive group' => [
                ['class' => 'btn btn-secondary'],
                ['class' => 'btn-secondary'],
                ['class' => 'btn btn-primary'],
                ['btn-primary btn-secondary']
            ],
            'negative directive removes one default class' => [
                ['class' => 'btn btn-orange'],
                ['class' => 'btn-orange -btn-primary'],
                ['class' => 'btn btn-primary'],
                []
            ],
            'negative directives remove all defaults' => [
                ['class' => 'button-base shadow-md text-brand'],
                ['class' => '-btn -btn-primary button-base shadow-md text-brand'],
                ['class' => 'btn btn-primary'],
                ['btn-primary btn-secondary']
            ],
            'non-class attributes are merged' => [
                ['style' => 'color:red', 'id' => 'myId'],
                ['id' => 'myId'],
                ['style' => 'color:red'],
                []
            ],
            'class and non-class attributes merged together' => [
                ['class' => 'btn btn-sm', 'data-action' => 'submit', 'id' => 'submitBtn'],
                ['class' => 'btn-sm', 'id' => 'submitBtn'],
                ['class' => 'btn btn-lg', 'data-action' => 'submit'],
                ['btn-sm btn-lg']
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

    static function consumeScopedPseudoAttributesDataProvider()
    {
        // attributes
        // scope
        // expectedResult
        // expectedRemaining
        return [
            'null attributes' => [
                null,
                'link',
                [],
                null
            ],
            'empty attributes' => [
                [],
                'link',
                [],
                []
            ],
            'non-matching scope' => [
                [':menu:id' => 'x'],
                'link',
                [],
                [':menu:id' => 'x']
            ],
            'ignored empty suffix' => [
                [':link:' => 'value', ':link:id' => 'ok'],
                'link',
                ['id' => 'ok'],
                [':link:' => 'value']
            ],
            'case-sensitive scope' => [
                [':Link:id' => 'wrong', ':link:id' => 'ok'],
                'link',
                ['id' => 'ok'],
                [':Link:id' => 'wrong']
            ],
            'matching scoped attributes' => [
                [':link:id' => 'myId', ':link:data-role' => 'nav'],
                'link',
                ['id' => 'myId', 'data-role' => 'nav'],
                []
            ],
            'dashed and numeric attribute names' => [
                [':link:data-x' => 'value', ':link:role123' => 'presentation'],
                'link',
                ['data-x' => 'value', 'role123' => 'presentation'],
                []
            ],
            'negative class directive' => [
                [':link:class' => '-dropdown-item btn-alt'],
                'link',
                ['class' => '-dropdown-item btn-alt'],
                []
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
                function __toString(): string {
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
