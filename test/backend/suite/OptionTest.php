<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Option;

#[CoversClass(Option::class)]
class OptionTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Option();
        $this->assertSame(
            '<option></option>'
          , $component->Render()
        );
    }
}
