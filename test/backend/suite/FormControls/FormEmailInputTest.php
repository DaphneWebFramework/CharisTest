<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormEmailInput;

#[CoversClass(FormEmailInput::class)]
class FormEmailInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormEmailInput();
        $this->assertSame(
            '<input class="form-control" type="email"/>',
            $component->Render()
        );
    }
}
