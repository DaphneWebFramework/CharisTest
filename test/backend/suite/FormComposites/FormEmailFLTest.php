<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormEmailFL;

#[CoversClass(FormEmailFL::class)]
class FormEmailFLTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormEmailFL();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="email" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }
}
