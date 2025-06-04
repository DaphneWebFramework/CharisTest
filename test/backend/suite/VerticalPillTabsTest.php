<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\VerticalPillTabs;

#[CoversClass(VerticalPillTabs::class)]
class VerticalPillTabsTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new VerticalPillTabs();
        $this->assertSame(
            '<div class="nav nav-pills flex-column me-3" '
               . 'role="tablist" '
               . 'aria-orientation="vertical">'
          . '</div>'
          , $component->Render()
        );
    }
}
