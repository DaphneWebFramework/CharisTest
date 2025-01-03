<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormRadioInput;

#[CoversClass(FormRadioInput::class)]
class FormRadioInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormRadioInput();
        $this->assertSame(
            '<input class="form-check-input" type="radio" name=""/>',
            $component->Render()
        );
    }
}
