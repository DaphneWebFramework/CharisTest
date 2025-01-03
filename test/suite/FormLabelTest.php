<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormLabel;

#[CoversClass(FormLabel::class)]
class FormLabelTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormLabel();
        $this->assertSame(
            '<label for="" class="form-label">'
          . '</label>'
          , $component->Render()
        );
    }
}
