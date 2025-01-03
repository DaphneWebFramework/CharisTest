<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\ButtonGroup;
use \Charis\Button;

#[CoversClass(ButtonGroup::class)]
class ButtonGroupTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new ButtonGroup();
        $this->assertSame(
            '<div class="btn-group" role="group" aria-label="">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderVertical()
    {
        $component = new ButtonGroup(['class' => 'btn-group-vertical']);
        $this->assertSame(
            '<div class="btn-group-vertical" role="group" aria-label="">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithButtons()
    {
        $component = new ButtonGroup(['aria-label'=>'Basic button group'], [
            new Button(null, 'Left'),
            new Button(null, 'Middle'),
            new Button(null, 'Right')
        ]);
        $this->assertSame(
            '<div class="btn-group" role="group" aria-label="Basic button group">'
          .   '<button type="button" class="btn btn-primary">Left</button>'
          .   '<button type="button" class="btn btn-primary">Middle</button>'
          .   '<button type="button" class="btn btn-primary">Right</button>'
          . '</div>'
          , $component->Render()
        );
    }
}
