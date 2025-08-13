<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormTextFL;

#[CoversClass(FormTextFL::class)]
class FormTextFLTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormTextFL();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputId()
    {
        $component = new FormTextFL([':input:id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputName()
    {
        $component = new FormTextFL([':input:name' => 'Text1']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" name="Text1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputValue()
    {
        $component = new FormTextFL([':input:value' => 'Input Text']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" value="Input Text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new FormTextFL([':label' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" id="form-input-UID"/>'
          .   '<label for="form-input-UID">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabel()
    {
        $component = new FormTextFL([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text'
        ]);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" id="custom-id"/>'
          .   '<label for="custom-id">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelp()
    {
        $component = new FormTextFL([':help' => 'Help Text']);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelAndHelp()
    {
        $component = new FormTextFL([
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" id="form-input-UID" aria-describedby="form-help-UID"/>'
          .   '<label for="form-input-UID">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabelAndHelp()
    {
        $component = new FormTextFL([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" id="custom-id" aria-describedby="form-help-UID"/>'
          .   '<label for="custom-id">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputPlaceholder()
    {
        $component = new FormTextFL([':input:placeholder' => 'Placeholder Text']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="Placeholder Text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputAutocomplete()
    {
        $component = new FormTextFL([':input:autocomplete' => 'on']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" autocomplete="on"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputDisabled()
    {
        $component = new FormTextFL([':input:disabled' => true]);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputRequired()
    {
        $component = new FormTextFL([':input:required' => true]);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" required/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormTextFL([
            ':label' => 'Label Text',
            ':input:id' => 'custom-id',
            ':input:name' => 'Text1',
            ':input:value' => 'Input Text',
            ':input:autocomplete' => 'on',
            ':input:disabled' => true,
            ':input:required' => true,
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control"'
          .         ' type="text"'
          .         ' placeholder=""'
          .         ' id="custom-id"'
          .         ' aria-describedby="form-help-UID"'
          .         ' name="Text1"'
          .         ' value="Input Text"'
          .         ' autocomplete="on"'
          .         ' disabled'
          .         ' required/>'
          .   '<label for="custom-id">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
