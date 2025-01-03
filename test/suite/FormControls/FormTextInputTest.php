<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormTextInput;

#[CoversClass(FormTextInput::class)]
class FormTextInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormTextInput();
        $this->assertSame(
            '<input class="form-control" type="text"/>',
            $component->Render()
        );
    }
}
