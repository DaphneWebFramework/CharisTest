<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\ComponentHelper;

#[CoversClass(ComponentHelper::class)]
class ComponentHelperTest extends TestCase
{
    #region ResolveClasses -----------------------------------------------------

    #[DataProvider('resolveClassesDataProvider')]
    function testResolveClasses($expected, $defaultClasses, $userClasses,
        $mutuallyExclusiveClassGroups = [])
    {
        $result = ComponentHelper::ResolveClasses($defaultClasses, $userClasses,
            $mutuallyExclusiveClassGroups);
        // For order-insensitive comparison, split classes into arrays and sort
        // both arrays.
        $expected = ComponentHelper::ParseClassList($expected);
        $result = ComponentHelper::ParseClassList($result);
        sort($expected);
        sort($result);
        $this->assertSame($expected, $result);
    }

    #endregion ResolveClasses

    #region Data Providers -----------------------------------------------------

    public static function resolveClassesDataProvider()
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
