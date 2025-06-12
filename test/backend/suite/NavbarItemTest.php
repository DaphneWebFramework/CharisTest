<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarItem;

#[CoversClass(NavbarItem::class)]
class NavbarItemTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarItem();
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="nav-link" href="#">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new NavbarItem([':label' => 'Home']);
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="nav-link" href="#">'
          .     'Home'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithHref()
    {
        $component = new NavbarItem([':href' => '/home']);
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="nav-link" href="/home">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithActive()
    {
        $component = new NavbarItem([':active' => true]);
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="nav-link active" href="#" aria-current="page">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new NavbarItem([':disabled' => true]);
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="nav-link disabled" href="#" aria-disabled="true">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithAttributesForWrapper()
    {
        $component = new NavbarItem(['class' => 'custom-class']);
        $this->assertSame(
            '<li class="nav-item custom-class">'
          .   '<a class="nav-link" href="#">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }

    function testRenderWithScopedPseudoAttributes()
    {
        $component = new NavbarItem([
            ':link:class' => '-nav-link custom-class'
        ]);
        $this->assertSame(
            '<li class="nav-item">'
          .   '<a class="custom-class" href="#">'
          .   '</a>'
          . '</li>'
          , $component->Render()
        );
    }
}
