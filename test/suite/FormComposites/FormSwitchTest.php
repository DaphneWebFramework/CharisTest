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
        $component = new FormSwitch();
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithId()
    {
        $component = new FormSwitch([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithName()
    {
        $component = new FormSwitch([':name' => 'Switch1']);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" name="Switch1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $component = new FormSwitch([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="form-input-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $component = new FormSwitch([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $component = new FormSwitch([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $component = new FormSwitch([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $component = new FormSwitch([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithChecked()
    {
        $component = new FormSwitch([
            ':checked' => true
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $component = new FormSwitch([
            ':checked' => true,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new FormSwitch([
            ':disabled' => true
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $component = new FormSwitch([
            ':checked' => false,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $component = new FormSwitch([
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" checked disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $component = new FormSwitch([
            ':checked' => false,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormSwitch([
            ':id' => 'custom-id',
            ':name' => 'Switch1',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check form-switch">'
          .   '<input class="form-check-input" type="checkbox" role="switch" id="custom-id" name="Switch1" aria-describedby="form-help-text-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
