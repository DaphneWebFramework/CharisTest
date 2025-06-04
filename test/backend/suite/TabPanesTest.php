<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\TabPanes;

#[CoversClass(TabPanes::class)]
class TabPanesTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new TabPanes();
        $this->assertSame(
            '<div class="tab-content">'
          . '</div>'
          , $component->Render()
        );
    }
}
