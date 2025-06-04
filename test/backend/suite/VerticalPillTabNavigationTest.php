<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\VerticalPillTabNavigation;

#[CoversClass(VerticalPillTabNavigation::class)]
class VerticalPillTabNavigationTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new VerticalPillTabNavigation();
        $this->assertSame(
            '<div class="d-flex align-items-start">'
          . '</div>'
          , $component->Render()
        );
    }
}
