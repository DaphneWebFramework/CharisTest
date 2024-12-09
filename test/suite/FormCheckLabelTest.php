<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormCheckLabel;

#[CoversClass(FormCheckLabel::class)]
class FormCheckLabelTest extends TestCase
{
    function testDefaultRendering()
    {
        $formCheckLabel = new FormCheckLabel();
        $this->assertSame(
            $formCheckLabel->Render(),
            '<label class="form-check-label" for=""></label>'
        );
    }
}
