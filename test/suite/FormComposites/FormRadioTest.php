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
        $formRadio = new FormRadio();
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name=""/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithId()
    {
        $formRadio = new FormRadio([':id'=>'custom-id']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id"/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithName()
    {
        $formRadio = new FormRadio([':name'=>'Radio1']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="Radio1"/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $formRadio = new FormRadio([':label-text'=>'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $formRadio = new FormRadio([':id'=>'custom-id', ':label-text'=>'Label Text']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $formRadio = new FormRadio([':help-text'=>'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $formRadio = new FormRadio([
            ':label-text'=>'Label Text',
            ':help-text'=>'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $formRadio = new FormRadio([
            ':id'=>'custom-id',
            ':label-text'=>'Label Text',
            ':help-text'=>'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithChecked()
    {
        $formRadio = new FormRadio([
            ':checked'=>true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $formRadio = new FormRadio([
            ':checked'=>true,
            ':disabled'=>false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $formRadio = new FormRadio([
            ':disabled'=>true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" disabled/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $formRadio = new FormRadio([
            ':checked'=>false,
            ':disabled'=>true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" disabled/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $formRadio = new FormRadio([
            ':checked'=>true,
            ':disabled'=>true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="" checked disabled/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $formRadio = new FormRadio([
            ':checked'=>false,
            ':disabled'=>false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name=""/>'
          . '</div>',
            $formRadio->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $formRadio = new FormRadio([
            ':id'=>'custom-id',
            ':name'=>'Radio1',
            ':label-text'=>'Label Text',
            ':help-text'=>'This is a help text.',
            ':checked'=>true,
            ':disabled'=>true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="radio" name="Radio1" id="custom-id" aria-describedby="form-help-text-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formRadio->Render()
        );
    }
}
