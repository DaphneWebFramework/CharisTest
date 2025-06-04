<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\VerticalPillTabLayout;

#[CoversClass(VerticalPillTabLayout::class)]
class VerticalPillTabLayoutTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new VerticalPillTabLayout();
        $this->assertSame(
            '<div class="d-flex align-items-start">'
          . '</div>'
          , $component->Render()
        );
    }
}
