<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarDropdown;

#[CoversClass(NavbarDropdown::class)]
class NavbarDropdownTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarDropdown();
        $this->assertSame(
            '<li class="nav-item dropdown">'
          .   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
          .   '</a>'
          .   '<ul class="dropdown-menu">'
          .   '</ul>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new NavbarDropdown([':label' => 'Settings']);
        $this->assertSame(
            '<li class="nav-item dropdown">'
          .   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
          .       'Settings'
          .   '</a>'
          .   '<ul class="dropdown-menu">'
          .   '</ul>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new NavbarDropdown([':disabled' => true]);
        $this->assertSame(
            '<li class="nav-item dropdown">'
          .   '<a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-disabled="true">'
          .   '</a>'
          .   '<ul class="dropdown-menu">'
          .   '</ul>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new NavbarDropdown([
            ':label' => 'Settings',
            ':disabled' => true
        ]);
        $this->assertSame(
            '<li class="nav-item dropdown">'
          .   '<a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-disabled="true">'
          .       'Settings'
          .   '</a>'
          .   '<ul class="dropdown-menu">'
          .   '</ul>'
          . '</li>'
          , $component->Render()
        );
    }
}
