<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormCheck;

#[CoversClass(FormCheck::class)]
class FormCheckTest extends TestCase
{
    private function assertMatchesWithUID(string $actual, string $expected): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $formCheck = new FormCheck();
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>'
        );
    }

    function testRenderWithId()
    {
        $formCheck = new FormCheck([':id' => 'custom-id']);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          . '</div>'
        );
    }

    function testRenderWithLabelText()
    {
        $formCheck = new FormCheck([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-check-UID"/>'
          .   '<label class="form-check-label" for="form-check-UID">Label Text</label>'
          . '</div>'
        );
    }


    function testRenderWithIdAndLabelText()
    {
        $formCheck = new FormCheck([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          .   '<label class="form-check-label" for="custom-id">Label Text</label>'
          . '</div>'
        );
    }

    function testRenderWithHelpText()
    {
        $formCheck = new FormCheck([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" aria-describedby="help-text-UID"/>'
          .   '<div id="help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $formCheck = new FormCheck([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-check-UID" aria-describedby="help-text-UID"/>'
          .   '<label class="form-check-label" for="form-check-UID">Label Text</label>'
          .   '<div id="help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $formCheck = new FormCheck([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" aria-describedby="help-text-UID"/>'
          .   '<label class="form-check-label" for="custom-id">Label Text</label>'
          .   '<div id="help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
        );
    }

    function testRenderWithChecked()
    {
        $formCheck = new FormCheck([
            ':checked' => true
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>'
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => true,
            ':disabled' => false,
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
        .   '<input class="form-check-input" type="checkbox" checked/>'
        . '</div>'
        );
    }

    function testRenderWithDisabled()
    {
        $formCheck = new FormCheck([
            ':disabled' => true
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>'
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => false,
            ':disabled' => true,
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
        .   '<input class="form-check-input" type="checkbox" disabled/>'
        . '</div>'
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked disabled/>'
          . '</div>'
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => false,
            ':disabled' => false,
        ]);
        $this->assertSame(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>'
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $formCheck = new FormCheck([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            $formCheck->Render(),
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" aria-describedby="help-text-UID" checked disabled/>'
          .   '<label class="form-check-label" for="custom-id">Label Text</label>'
          .   '<div id="help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
        );
    }
}
