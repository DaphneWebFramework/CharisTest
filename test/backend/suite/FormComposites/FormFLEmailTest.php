<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormFLEmail;

#[CoversClass(FormFLEmail::class)]
class FormFLEmailTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new FormFLEmail();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="email" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }
}
