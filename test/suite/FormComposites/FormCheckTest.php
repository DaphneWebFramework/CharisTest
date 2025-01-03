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
        $formCheck = new FormCheck();
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithId()
    {
        $formCheck = new FormCheck([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithName()
    {
        $formCheck = new FormCheck([':name' => 'Check1']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" name="Check1"/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $formCheck = new FormCheck([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $formCheck = new FormCheck([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $formCheck = new FormCheck([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $formCheck = new FormCheck([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formCheck->Render()
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
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithChecked()
    {
        $formCheck = new FormCheck([
            ':checked' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => true,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $formCheck = new FormCheck([
            ':disabled' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => false,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked disabled/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $formCheck = new FormCheck([
            ':checked' => false,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>',
            $formCheck->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $formCheck = new FormCheck([
            ':id' => 'custom-id',
            ':name' => 'Check1',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" name="Check1" aria-describedby="form-help-text-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formCheck->Render()
        );
    }
}
