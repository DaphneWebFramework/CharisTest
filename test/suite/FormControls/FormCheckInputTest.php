<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormCheckInput;

#[CoversClass(FormCheckInput::class)]
class FormCheckInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormCheckInput();
        $this->assertSame(
            '<input class="form-check-input" type="checkbox"/>',
            $component->Render()
        );
    }
}
