<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormHelpText;

#[CoversClass(FormHelpText::class)]
class FormHelpTextTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormHelpText();
        $this->assertSame(
            '<div id="" class="form-text">'
          . '</div>'
          , $component->Render()
        );
    }
}
