<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormInput;

#[CoversClass(FormInput::class)]
class FormInputTest extends TestCase
{
    function testDefaultRendering()
    {
        $formInput = new FormInput();
        $this->assertSame(
            '<input class="form-control"/>',
            $formInput->Render()
        );
    }
}
