<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormPasswordInput;

#[CoversClass(FormPasswordInput::class)]
class FormPasswordInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormPasswordInput();
        $this->assertSame(
            '<input class="form-control" type="password" minlength="8" maxlength="72"/>',
            $component->Render()
        );
    }
}
