<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormTextArea;

#[CoversClass(FormTextArea::class)]
class FormTextAreaTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormTextArea();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<textarea class="form-control"></textarea>'
          . '</div>'
          , $component->Render()
        );
    }
}
