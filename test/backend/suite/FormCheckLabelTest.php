<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormCheckLabel;

#[CoversClass(FormCheckLabel::class)]
class FormCheckLabelTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormCheckLabel();
        $this->assertSame(
            '<label for="" class="form-check-label">'
          . '</label>'
          , $component->Render()
        );
    }
}
