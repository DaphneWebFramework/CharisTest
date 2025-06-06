<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Form;

#[CoversClass(Form::class)]
class FormTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Form();
        $this->assertSame(
            '<form spellcheck="false">'
          . '</form>'
          , $component->Render()
        );
    }
}
