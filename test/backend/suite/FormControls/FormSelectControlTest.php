<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormControls\FormSelectControl;

#[CoversClass(FormSelectControl::class)]
class FormSelectControlTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormSelectControl();
        $this->assertSame(
            '<select class="form-select"></select>',
            $component->Render()
        );
    }
}
