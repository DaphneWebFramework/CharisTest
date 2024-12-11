<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormLabel;

#[CoversClass(FormLabel::class)]
class FormLabelTest extends TestCase
{
    function testDefaultRendering()
    {
        $formLabel = new FormLabel();
        $this->assertSame(
            '<label class="form-label" for=""></label>',
            $formLabel->Render()
        );
    }

    function testRenderWithAttributesAndContent()
    {
        $formLabel = new FormLabel(['for'=>'form-input-64f1a3b9e8341'], 'Username:');
        $this->assertSame(
            '<label class="form-label" for="form-input-64f1a3b9e8341">Username:</label>',
            $formLabel->Render()
        );
    }
}
