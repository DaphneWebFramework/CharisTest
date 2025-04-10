<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormPasswordFL;

#[CoversClass(FormPasswordFL::class)]
class FormPasswordFLTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormPasswordFL();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="password" minlength="8" maxlength="72" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }
}
