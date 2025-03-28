<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Container;

#[CoversClass(Container::class)]
class ContainerTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Container();
        $this->assertSame(
            '<div class="container">'
          . '</div>'
          , $component->Render()
        );
    }

    #[DataProvider('sizeProvider')]
    function testRenderSize($expected, $attributes)
    {
        $component = new Container($attributes);
        $this->assertSame($expected, $component->Render());
    }

    #region Data Providers -----------------------------------------------------

    static function sizeProvider()
    {
        return [
            [
                '<div class="container-sm"></div>',
                ['class' => 'container-sm']
            ],
            [
                '<div class="container-md"></div>',
                ['class' => 'container-md']
            ],
            [
                '<div class="container-lg"></div>',
                ['class' => 'container-lg']
            ],
            [
                '<div class="container-xl"></div>',
                ['class' => 'container-xl']
            ],
            [
                '<div class="container-xxl"></div>',
                ['class' => 'container-xxl']
            ],
            [
                '<div class="container-fluid"></div>',
                ['class' => 'container-fluid']
            ],
        ];
    }

    #endregion Data Providers
}
