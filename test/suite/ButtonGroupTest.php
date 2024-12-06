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
        $buttonGroup = new ButtonGroup();
        $this->assertEquals(
            '<div class="btn-group" role="group" aria-label=""></div>',
            $buttonGroup->Render()
        );
    }

    function testRenderWithButtons()
    {
        $button1 = new Button(['class' => 'btn-warning'], 'Button 1');
        $button2 = new Button(['class' => 'btn-danger'], 'Button 2');
        $buttonGroup = new ButtonGroup(null, [$button1, $button2]);
        $this->assertEquals(
            '<div class="btn-group" role="group" aria-label="">'
            . '<button type="button" class="btn btn-warning">Button 1</button>'
            . '<button type="button" class="btn btn-danger">Button 2</button>'
            . '</div>',
            $buttonGroup->Render()
        );
    }

    function testCustomAttributes()
    {
        $button1 = new Button(null, 'Button 1');
        $buttonGroup = new ButtonGroup(
            ['id' => 'testGroup', 'class' => 'btn-group-lg', 'aria-label' => 'Test Group'],
            [$button1]
        );
        $this->assertEquals(
            '<div class="btn-group-lg btn-group" role="group" aria-label="Test Group" id="testGroup">'
            . '<button type="button" class="btn btn-primary">Button 1</button>'
            . '</div>',
            $buttonGroup->Render()
        );
    }

    function testMutuallyExclusiveClasses()
    {
        $buttonGroup = new ButtonGroup(['class' => 'btn-group-vertical']);
        $this->assertEquals(
            '<div class="btn-group-vertical" role="group" aria-label=""></div>',
            $buttonGroup->Render()
        );
    }
}
