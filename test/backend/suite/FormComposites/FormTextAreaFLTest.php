<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormTextAreaFL;

#[CoversClass(FormTextAreaFL::class)]
class FormTextAreaFLTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormTextAreaFL();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<textarea class="form-control" placeholder=""></textarea>'
          . '</div>'
          , $component->Render()
        );
    }
}
