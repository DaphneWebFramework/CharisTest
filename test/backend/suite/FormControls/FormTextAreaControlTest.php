<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormTextAreaControl;

#[CoversClass(FormTextAreaControl::class)]
class FormTextAreaControlTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormTextAreaControl();
        $this->assertSame(
            '<textarea class="form-control"></textarea>',
            $component->Render()
        );
    }
}
