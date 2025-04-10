<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormPassword;

#[CoversClass(FormPassword::class)]
class FormPasswordTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormPassword();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="password" minlength="8" maxlength="72"/>'
          . '</div>'
          , $component->Render()
        );
    }
}
