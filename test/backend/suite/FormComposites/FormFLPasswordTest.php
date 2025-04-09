<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormFLPassword;

#[CoversClass(FormFLPassword::class)]
class FormFLPasswordTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormFLPassword();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="password" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }
}
