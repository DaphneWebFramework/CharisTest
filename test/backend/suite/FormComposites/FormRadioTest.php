<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormRadio;

#[CoversClass(FormRadio::class)]
class FormRadioTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormRadio();
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name=""/>'
          . '</div>'
          , $component->Render()
        );
    }
}
