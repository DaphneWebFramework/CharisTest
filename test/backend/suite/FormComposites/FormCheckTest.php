<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormCheck;

#[CoversClass(FormCheck::class)]
class FormCheckTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormCheck();
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputId()
    {
        $component = new FormCheck([':input:id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputName()
    {
        $component = new FormCheck([':input:name' => 'Check1']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" name="Check1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new FormCheck([':label' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabel()
    {
        $component = new FormCheck([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text'
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelp()
    {
        $component = new FormCheck([':help' => 'Help Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelAndHelp()
    {
        $component = new FormCheck([
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-input-UID" aria-describedby="form-help-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputIdAndLabelAndHelp()
    {
        $component = new FormCheck([
            ':input:id' => 'custom-id',
            ':label' => 'Label Text',
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" aria-describedby="form-help-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputChecked()
    {
        $component = new FormCheck([
            ':input:checked' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputDisabled()
    {
        $component = new FormCheck([
            ':input:disabled' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputNotCheckedAndNotDisabled()
    {
        $component = new FormCheck([
            ':input:checked' => false,
            ':input:disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputNotCheckedAndDisabled()
    {
        $component = new FormCheck([
            ':input:checked' => false,
            ':input:disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputCheckedAndNotDisabled()
    {
        $component = new FormCheck([
            ':input:checked' => true,
            ':input:disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithInputCheckedAndDisabled()
    {
        $component = new FormCheck([
            ':input:checked' => true,
            ':input:disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormCheck([
            ':label' => 'Label Text',
            ':input:id' => 'custom-id',
            ':input:name' => 'Check1',
            ':input:checked' => true,
            ':input:disabled' => true,
            ':help' => 'Help Text',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input"'
          .         ' type="checkbox"'
          .         ' id="custom-id"'
          .         ' aria-describedby="form-help-UID"'
          .         ' name="Check1"'
          .         ' checked'
          .         ' disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">Help Text</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
