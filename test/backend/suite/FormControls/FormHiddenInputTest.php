<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormHiddenInput;

#[CoversClass(FormHiddenInput::class)]
class FormHiddenInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormHiddenInput();
        $this->assertSame(
            '<input type="hidden"/>',
            $component->Render()
        );
    }
}
