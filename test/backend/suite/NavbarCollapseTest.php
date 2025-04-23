<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarCollapse;

#[CoversClass(NavbarCollapse::class)]
class NavbarCollapseTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarCollapse();
        $this->assertSame(
            '<div id="" class="collapse navbar-collapse">'
          . '</div>'
          , $component->Render()
        );
    }
}
