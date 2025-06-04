<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\TabContent;

#[CoversClass(TabContent::class)]
class TabContentTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new TabContent();
        $this->assertSame(
            '<div class="tab-content">'
          . '</div>'
          , $component->Render()
        );
    }
}
