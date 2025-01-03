<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Label;

#[CoversClass(Label::class)]
class LabelTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Label();
        $this->assertSame(
            '<label for="">'
          . '</label>'
          , $component->Render()
        );
    }
}
