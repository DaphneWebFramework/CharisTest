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
        $buttonToolbar = new ButtonToolbar();
        $this->assertEquals(
            $buttonToolbar->Render(),
            '<div class="btn-toolbar" role="toolbar" aria-label=""></div>'
        );
    }

    function testRenderWithButtonGroups()
    {
        $buttonToolbar = new ButtonToolbar(['aria-label'=>'Button toolbar'], [
          new ButtonGroup(['class'=>'me-2', 'aria-label'=>'First group'], [
            new Button(null, '1'),
            new Button(null, '2'),
            new Button(null, '3'),
            new Button(null, '4')
          ]),
          new ButtonGroup(['class'=>'me-2', 'aria-label'=>'Second group'], [
            new Button(['class'=>'btn-secondary'], '5'),
            new Button(['class'=>'btn-secondary'], '6'),
            new Button(['class'=>'btn-secondary'], '7')
          ]),
          new ButtonGroup(['aria-label'=>'Third group'], [
            new Button(['class'=>'btn-info'], '8')
          ]),
        ]);
        $this->assertEquals(
            $buttonToolbar->Render(),
            '<div class="btn-toolbar" role="toolbar" aria-label="Button toolbar">'
          .   '<div class="me-2 btn-group" role="group" aria-label="First group">'
          .     '<button type="button" class="btn btn-primary">1</button>'
          .     '<button type="button" class="btn btn-primary">2</button>'
          .     '<button type="button" class="btn btn-primary">3</button>'
          .     '<button type="button" class="btn btn-primary">4</button>'
          .   '</div>'
          .   '<div class="me-2 btn-group" role="group" aria-label="Second group">'
          .     '<button type="button" class="btn btn-secondary">5</button>'
          .     '<button type="button" class="btn btn-secondary">6</button>'
          .     '<button type="button" class="btn btn-secondary">7</button>'
          .   '</div>'
          .   '<div class="btn-group" role="group" aria-label="Third group">'
          .     '<button type="button" class="btn btn-info">8</button>'
          .   '</div>'
          . '</div>'
        );
    }
}