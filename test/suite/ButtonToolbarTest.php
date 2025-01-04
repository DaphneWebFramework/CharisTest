<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\ButtonToolbar;
use \Charis\ButtonGroup;
use \Charis\Button;

#[CoversClass(ButtonToolbar::class)]
class ButtonToolbarTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new ButtonToolbar();
        $this->assertSame(
            '<div class="btn-toolbar" role="toolbar">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithButtonGroups()
    {
        $component = new ButtonToolbar([], [
            new ButtonGroup(['class'=>'me-2'], [
                new Button(null, '1'),
                new Button(null, '2'),
                new Button(null, '3'),
                new Button(null, '4')
            ]),
            new ButtonGroup(['class'=>'me-2'], [
                new Button(['class'=>'btn-secondary'], '5'),
                new Button(['class'=>'btn-secondary'], '6'),
                new Button(['class'=>'btn-secondary'], '7')
            ]),
            new ButtonGroup([], [
                new Button(['class'=>'btn-info'], '8')
            ]),
        ]);
        $this->assertSame(
            '<div class="btn-toolbar" role="toolbar">'
          .   '<div class="me-2 btn-group" role="group">'
          .     '<button type="button" class="btn btn-primary">1</button>'
          .     '<button type="button" class="btn btn-primary">2</button>'
          .     '<button type="button" class="btn btn-primary">3</button>'
          .     '<button type="button" class="btn btn-primary">4</button>'
          .   '</div>'
          .   '<div class="me-2 btn-group" role="group">'
          .     '<button type="button" class="btn btn-secondary">5</button>'
          .     '<button type="button" class="btn btn-secondary">6</button>'
          .     '<button type="button" class="btn btn-secondary">7</button>'
          .   '</div>'
          .   '<div class="btn-group" role="group">'
          .     '<button type="button" class="btn btn-info">8</button>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
