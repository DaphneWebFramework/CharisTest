<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormSwitch;

#[CoversClass(FormSwitch::class)]
class FormSwitchTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormSwitch();
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" switch/>'
          . '</div>'
          , $component->Render()
        );
    }
}
