<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormRadioInput;

#[CoversClass(FormRadioInput::class)]
class FormRadioInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $formRadioInput = new FormRadioInput();
        $this->assertSame(
            '<input class="form-check-input" type="radio" name=""/>',
            $formRadioInput->Render()
        );
    }
}
