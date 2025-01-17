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

    function testRenderWithId()
    {
        $component = new FormCheck([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithName()
    {
        $component = new FormCheck([':name' => 'Check1']);
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

    function testRenderWithIdAndLabel()
    {
        $component = new FormCheck([
            ':id' => 'custom-id',
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
        $component = new FormCheck([':help' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" aria-describedby="form-help-UID"/>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelAndHelp()
    {
        $component = new FormCheck([
            ':label' => 'Label Text',
            ':help' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="form-input-UID" aria-describedby="form-help-UID"/>'
          .   '<label for="form-input-UID" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelAndHelp()
    {
        $component = new FormCheck([
            ':id' => 'custom-id',
            ':label' => 'Label Text',
            ':help' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" aria-describedby="form-help-UID"/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithChecked()
    {
        $component = new FormCheck([
            ':checked' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndNotDisabled()
    {
        $component = new FormCheck([
            ':checked' => true,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new FormCheck([
            ':disabled' => true
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndDisabled()
    {
        $component = new FormCheck([
            ':checked' => false,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCheckedAndDisabled()
    {
        $component = new FormCheck([
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" checked disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithNotCheckedAndNotDisabled()
    {
        $component = new FormCheck([
            ':checked' => false,
            ':disabled' => false,
        ]);
        $this->assertSame(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormCheck([
            ':id' => 'custom-id',
            ':name' => 'Check1',
            ':label' => 'Label Text',
            ':help' => 'This is a help text.',
            ':checked' => true,
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-check">'
          .   '<input class="form-check-input" type="checkbox" id="custom-id" name="Check1" aria-describedby="form-help-UID" checked disabled/>'
          .   '<label for="custom-id" class="form-check-label">Label Text</label>'
          .   '<div id="form-help-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
