<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarDropdownItem;

#[CoversClass(NavbarDropdownItem::class)]
class NavbarDropdownItemTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarDropdownItem();
        $this->assertSame(
            '<li>'
          .   '<a class="dropdown-item" href="#">'
          .   '</a>'
          . '</li>',
            $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new NavbarDropdownItem([':label' => 'Profile']);
        $this->assertSame(
            '<li>'
          .   '<a class="dropdown-item" href="#">'
          .     'Profile'
          .   '</a>'
          . '</li>',
            $component->Render()
        );
    }

    function testRenderWithHref()
    {
        $component = new NavbarDropdownItem([':href' => '/profile']);
        $this->assertSame(
            '<li>'
          .   '<a class="dropdown-item" href="/profile">'
          .   '</a>'
          . '</li>',
            $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new NavbarDropdownItem([':disabled' => true]);
        $this->assertSame(
            '<li>'
          .   '<a class="dropdown-item disabled" href="#" aria-disabled="true">'
          .   '</a>'
          . '</li>',
            $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new NavbarDropdownItem([
            ':label' => 'Profile',
            ':href' => '/profile',
            ':disabled' => true
        ]);
        $this->assertSame(
            '<li>'
          .   '<a class="dropdown-item disabled" href="/profile" aria-disabled="true">'
          .     'Profile'
          .   '</a>'
          . '</li>',
            $component->Render()
        );
    }
}
