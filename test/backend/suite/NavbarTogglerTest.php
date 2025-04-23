<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarToggler;

#[CoversClass(NavbarToggler::class)]
class NavbarTogglerTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarToggler();
        $this->assertSame(
            '<button type="button"'
          .        ' class="navbar-toggler"'
          .        ' data-bs-toggle="collapse"'
          .        ' data-bs-target=""'
          .        ' aria-controls=""'
          .        ' aria-expanded="false"'
          .        ' aria-label="Toggle navigation">'
          .   '<span class="navbar-toggler-icon"></span>'
          . '</button>'
          , $component->Render()
        );
    }
}
