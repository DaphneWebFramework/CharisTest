<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Collapse;

#[CoversClass(Collapse::class)]
class CollapseTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Collapse();
        $this->assertSame(
            '<div id="" class="collapse">'
          . '</div>'
          , $component->Render()
        );
    }
}
