<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Navbar;

#[CoversClass(Navbar::class)]
class NavbarTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Navbar();
        $this->assertSame(
            '<nav class="navbar bg-body-tertiary">'
          . '</nav>'
          , $component->Render()
        );
    }

    #[DataProvider('expandSizeProvider')]
    function testRenderExpandSize($expected, $attributes)
    {
        $component = new Navbar($attributes);
        $this->assertSame($expected, $component->Render());
    }

    #[DataProvider('backgroundColorDataProvider')]
    function testRenderBackgroundColor($expected, $attributes)
    {
        $component = new Navbar($attributes);
        $this->assertSame($expected, $component->Render());
    }

    #region Data Providers -----------------------------------------------------

    static function expandSizeProvider()
    {
        return [
            [
                '<nav class="navbar bg-body-tertiary navbar-expand"></nav>',
                ['class' => 'navbar-expand']
            ],
            [
                '<nav class="navbar bg-body-tertiary navbar-expand-sm"></nav>',
                ['class' => 'navbar-expand-sm']
            ],
            [
                '<nav class="navbar bg-body-tertiary navbar-expand-md"></nav>',
                ['class' => 'navbar-expand-md']
            ],
            [
                '<nav class="navbar bg-body-tertiary navbar-expand-lg"></nav>',
                ['class' => 'navbar-expand-lg']
            ],
            [
                '<nav class="navbar bg-body-tertiary navbar-expand-xl"></nav>',
                ['class' => 'navbar-expand-xl']
            ],
            [
                '<nav class="navbar bg-body-tertiary navbar-expand-xxl"></nav>',
                ['class' => 'navbar-expand-xxl']
            ],
        ];
    }

    static function backgroundColorDataProvider()
    {
        return [
            [
                '<nav class="navbar bg-body-tertiary"></nav>',
                ['class' => 'bg-body-tertiary']
            ],
            [
                '<nav class="navbar bg-primary"></nav>',
                ['class' => 'bg-primary']
            ],
            [
                '<nav class="navbar bg-secondary"></nav>',
                ['class' => 'bg-secondary']
            ],
            [
                '<nav class="navbar bg-success"></nav>',
                ['class' => 'bg-success']
            ],
            [
                '<nav class="navbar bg-info"></nav>',
                ['class' => 'bg-info']
            ],
            [
                '<nav class="navbar bg-warning"></nav>',
                ['class' => 'bg-warning']
            ],
            [
                '<nav class="navbar bg-danger"></nav>',
                ['class' => 'bg-danger']
            ],
            [
                '<nav class="navbar bg-light"></nav>',
                ['class' => 'bg-light']
            ],
            [
                '<nav class="navbar bg-dark"></nav>',
                ['class' => 'bg-dark']
            ]
        ];
    }


    #endregion Data Providers
}
