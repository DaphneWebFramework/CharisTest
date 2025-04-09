<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormEmail;

#[CoversClass(FormEmail::class)]
class FormEmailTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormEmail();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="email"/>'
          . '</div>'
          , $component->Render()
        );
    }
}
