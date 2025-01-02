<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormSwitchInput;

#[CoversClass(FormSwitchInput::class)]
class FormSwitchInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $formSwitchInput = new FormSwitchInput();
        $this->assertSame(
            '<input class="form-check-input" type="checkbox" role="switch"/>',
            $formSwitchInput->Render()
        );
    }
}
