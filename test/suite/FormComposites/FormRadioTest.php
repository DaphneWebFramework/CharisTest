<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormRadio;

#[CoversClass(FormRadio::class)]
class FormRadioTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormRadio();
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithId()
    {
        $component = new FormRadio([':id'=>'custom-id']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithName()
    {
        $component = new FormRadio([':name'=>'Radio1']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="Radio1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new FormRadio([':label'=>'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabel()
    {
        $component = new FormRadio([
            ':id'=>'custom-id',
            ':label'=>'Label Text'
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelp()
    {
        $component = new FormRadio([':help'=>'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelAndHelp()
    {
        $component = new FormRadio([
            ':label'=>'Label Text',
            ':help'=>'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="form-input-UID" aria-describedby="form-help-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelAndHelp()
    {
        $component = new FormRadio([
            ':id'=>'custom-id',
            ':label'=>'Label Text',
            ':help'=>'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id" aria-describedby="form-help-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithChecked()
    {
        $component = new FormRadio([
            ':checked'=>true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $component = new FormRadio([
            ':checked'=>true,
            ':disabled'=>false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new FormRadio([
            ':disabled'=>true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $component = new FormRadio([
            ':checked'=>false,
            ':disabled'=>true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $component = new FormRadio([
            ':checked'=>true,
            ':disabled'=>true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $component = new FormRadio([
            ':checked'=>false,
            ':disabled'=>false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormRadio([
            ':id'=>'custom-id',
            ':name'=>'Radio1',
            ':label'=>'Label Text',
            ':help'=>'This is a help text.',
            ':checked'=>true,
            ':disabled'=>true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="Radio1" id="custom-id" aria-describedby="form-help-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
