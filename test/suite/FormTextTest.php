<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormText;

#[CoversClass(FormText::class)]
class FormTextTest extends TestCase
{
    function testDefaultRendering()
    {
        $formText = new FormText();
        $this->assertSame(
            '<div id="" class="form-text"></div>',
            $formText->Render()
        );
    }

    function testRenderWithAttributesAndContent()
    {
        $formText = new FormText(
            ['id'=>'form-text-64f1a3b9e8341'],
            'Please accept the terms and conditions.'
        );
        $this->assertSame(
            '<div id="form-text-64f1a3b9e8341" class="form-text">Please accept the terms and conditions.</div>',
            $formText->Render()
        );
    }
}
