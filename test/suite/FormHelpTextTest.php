<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormHelpText;

#[CoversClass(FormHelpText::class)]
class FormHelpTextTest extends TestCase
{
    function testDefaultRendering()
    {
        $formHelpText = new FormHelpText();
        $this->assertSame(
            '<div id="" class="form-text"></div>',
            $formHelpText->Render()
        );
    }

    function testRenderWithAttributesAndContent()
    {
        $formHelpText = new FormHelpText(
            ['id'=>'form-text-64f1a3b9e8341'],
            'Please accept the terms and conditions.'
        );
        $this->assertSame(
            '<div id="form-text-64f1a3b9e8341" class="form-text">Please accept the terms and conditions.</div>',
            $formHelpText->Render()
        );
    }
}
