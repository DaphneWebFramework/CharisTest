<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormText;

#[CoversClass(FormText::class)]
class FormTextTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormText();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputId()
    {
        $component = new FormText([':input:id' => 'custom-id']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputName()
    {
        $component = new FormText([':input:name' => 'Text1']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" name="Text1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputValue()
    {
        $component = new FormText([':input:value' => 'Input Text']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" value="Input Text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new FormText([':label' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="form-input-UID" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabel()
    {
        $component = new FormText([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text'
        ]);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelp()
    {
        $component = new FormText([':help' => 'Help Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelAndHelp()
    {
        $component = new FormText([
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="form-input-UID" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabelAndHelp()
    {
        $component = new FormText([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputPlaceholder()
    {
        $component = new FormText([':input:placeholder' => 'Placeholder Text']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" placeholder="Placeholder Text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputAutocomplete()
    {
        $component = new FormText([':input:autocomplete' => 'on']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" autocomplete="on"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputDisabled()
    {
        $component = new FormText([':input:disabled' => true]);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputRequired()
    {
        $component = new FormText([':input:required' => true]);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" required/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormText([
            ':label' => 'Label Text',
            ':input:id' => 'custom-id',
            ':input:name' => 'Text1',
            ':input:value' => 'Input Text',
            ':input:placeholder' => 'Placeholder Text',
            ':input:autocomplete' => 'on',
            ':input:disabled' => true,
            ':input:required' => true,
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control"'
          .         ' type="text"'
          .         ' id="custom-id"'
          .         ' aria-describedby="form-help-UID"'
          .         ' name="Text1"'
          .         ' value="Input Text"'
          .         ' placeholder="Placeholder Text"'
          .         ' autocomplete="on"'
          .         ' disabled'
          .         ' required/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
