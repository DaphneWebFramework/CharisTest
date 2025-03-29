<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Footer;

#[CoversClass(Footer::class)]
class FooterTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Footer();
        $this->assertSame(
            '<footer>'
          . '</footer>'
          , $component->Render()
        );
    }
}
