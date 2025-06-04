<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\PillTab;

#[CoversClass(PillTab::class)]
class PillTabTest extends TestCase
{
    function testDefaultRendering()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new PillTab();
    }

    function testThrowsWhenKeyIsNotAString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new PillTab([':key' => 123]);
    }

    function testThrowsWhenKeyIsEmptyString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new PillTab([':key' => '']);
    }

    function testRenderWithKey()
    {
        $component = new PillTab([
            ':key' => 'settings'
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithActive()
    {
        $component = new PillTab([
            ':key' => 'settings',
            ':active' => true
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link active" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="true">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithExplicitlyInactive()
    {
        $component = new PillTab([
            ':key' => 'settings',
            ':active' => false
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new PillTab([
            ':key' => 'settings',
            'disabled' => true
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false" '
                  . 'disabled>'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithExplicitlyEnabled()
    {
        $component = new PillTab([
            ':key' => 'settings',
            'disabled' => false
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithExplicitlyEnabledAndActive()
    {
        $component = new PillTab([
            ':key' => 'settings',
            ':active' => true,
            'disabled' => false
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link active" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="true">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithActiveSuppressedByDisabled()
    {
        $component = new PillTab([
            ':key' => 'settings',
            ':active' => true,
            'disabled' => true
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false" '
                  . 'disabled>'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithCustomClassAndActive()
    {
        $component = new PillTab([
            ':key' => 'settings',
            ':active' => true,
            'class' => 'text-uppercase'
        ]);
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link text-uppercase active" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="true">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithUserDefinedIds()
    {
        $component = new PillTab([
            ':key' => 'settings',
            'id' => 'custom-tab-id',
            'data-bs-target' => '#custom-pane-id',
            'aria-controls' => 'custom-pane-id'
        ]);
        $this->assertSame(
            '<button id="custom-tab-id" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#custom-pane-id" '
                  . 'aria-controls="custom-pane-id" '
                  . 'aria-selected="false">'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithContent()
    {
        $component = new PillTab([
            ':key' => 'settings'
        ], 'Settings');
        $this->assertSame(
            '<button id="tab-settings" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-settings" '
                  . 'aria-controls="pane-settings" '
                  . 'aria-selected="false">'
              . 'Settings'
          . '</button>'
          , $component->Render()
        );
    }

    function testRenderWithMultipleContentElements()
    {
        $component = new PillTab([
            ':key' => 'preferences'
        ], [
            '<i class="bi bi-sliders"></i>',
            '<span class="label">Preferences</span>'
        ]);
        $this->assertSame(
            '<button id="tab-preferences" '
                  . 'class="nav-link" '
                  . 'type="button" '
                  . 'role="tab" '
                  . 'data-bs-toggle="pill" '
                  . 'data-bs-target="#pane-preferences" '
                  . 'aria-controls="pane-preferences" '
                  . 'aria-selected="false">'
              . '<i class="bi bi-sliders"></i>'
              . '<span class="label">Preferences</span>'
          . '</button>'
          , $component->Render()
        );
    }
}
