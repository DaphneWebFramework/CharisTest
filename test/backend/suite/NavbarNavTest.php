<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarNav;

#[CoversClass(NavbarNav::class)]
class NavbarNavTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarNav();
        $this->assertSame(
            '<ul class="navbar-nav">'
          . '</ul>'
          , $component->Render()
        );
    }
}
