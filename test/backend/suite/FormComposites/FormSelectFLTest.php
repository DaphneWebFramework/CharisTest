<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormSelectFL;

use \Charis\Option;

#[CoversClass(FormSelectFL::class)]
class FormSelectFLTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormSelectFL();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<select class="form-select" placeholder=""></select>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithOptions()
    {
        $component = new FormSelectFL([
            ':label' => 'Theme',
            ':help' => 'The theme you select will be applied to all pages.',
        ], [
            new Option(['selected' => true]),
            new Option(['value' => 'dark'], 'Dark'),
            new Option(['value' => 'light'], 'Light')
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<select class="form-select" placeholder="" id="form-input-UID" aria-describedby="form-help-UID">'
          .     '<option selected></option>'
          .     '<option value="dark">Dark</option>'
          .     '<option value="light">Light</option>'
          .   '</select>'
          .   '<label for="form-input-UID">Theme</label>'
          .   '<div id="form-help-UID" class="form-text">The theme you select will be applied to all pages.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
