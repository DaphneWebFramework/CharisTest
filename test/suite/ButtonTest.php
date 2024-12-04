<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Button;

#[CoversClass(Button::class)]
class ButtonTest extends TestCase
{
    function testDefaultRendering()
    {
        $button = new Button();
        $this->assertEquals(
            '<button type="button" class="btn btn-primary"></button>',
            $button->Render()
        );
    }

    function testRenderWithCustomAttributes()
    {
        $button = new Button([
            'id' => 'testButton', 'class' => 'btn-danger'
        ], 'Click Me');
        $this->assertEquals(
            '<button type="button" class="btn btn-danger" id="testButton">Click Me</button>',
            $button->Render()
        );
    }
}
