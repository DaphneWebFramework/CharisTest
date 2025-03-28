<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarBrand;

#[CoversClass(NavbarBrand::class)]
class NavbarBrandTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarBrand();
        $this->assertSame(
            '<a class="navbar-brand" href="#">'
          . '</a>'
          , $component->Render()
        );
    }
}
