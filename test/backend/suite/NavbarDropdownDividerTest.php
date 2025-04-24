<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\NavbarDropdownDivider;

#[CoversClass(NavbarDropdownDivider::class)]
class NavbarDropdownDividerTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new NavbarDropdownDivider();
        $this->assertSame(
            '<li>'
          .   '<hr class="dropdown-divider"/>'
          . '</li>',
            $component->Render()
        );
    }
}
