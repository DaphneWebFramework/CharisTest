<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormSwitch;

#[CoversClass(FormSwitch::class)]
class FormSwitchTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $formSwitch = new FormSwitch();
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch"/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithId()
    {
        $formSwitch = new FormSwitch([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id"/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $formSwitch = new FormSwitch([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $formSwitch = new FormSwitch([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $formSwitch = new FormSwitch([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $formSwitch = new FormSwitch([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $formSwitch = new FormSwitch([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithChecked()
    {
        $formSwitch = new FormSwitch([
            ':checked' => true
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $formSwitch = new FormSwitch([
            ':checked' => true,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $formSwitch = new FormSwitch([
            ':disabled' => true
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" disabled/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $formSwitch = new FormSwitch([
            ':checked' => false,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" disabled/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $formSwitch = new FormSwitch([
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked disabled/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $formSwitch = new FormSwitch([
            ':checked' => false,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch"/>'
          . '</div>',
            $formSwitch->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $formSwitch = new FormSwitch([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id" aria-describedby="form-help-text-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>',
            $formSwitch->Render()
        );
    }
}
