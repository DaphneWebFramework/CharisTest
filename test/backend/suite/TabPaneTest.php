<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProviderExternal;

use \Charis\TabPane;

use \TestToolkit\DataHelper;

#[CoversClass(TabPane::class)]
class TabPaneTest extends TestCase
{
    function testDefaultRendering()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new TabPane();
    }

    #[DataProviderExternal(DataHelper::class, 'NonStringProvider')]
    function testThrowsWhenKeyIsNotAString($key)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new TabPane([':key' => $key]);
    }

    function testThrowsWhenKeyIsEmptyString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The ":key" attribute must be a non-empty string.');
        $component = new TabPane([':key' => '']);
    }

    function testRenderWithKey()
    {
        $component = new TabPane([
            ':key' => 'settings'
        ]);
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithActive()
    {
        $component = new TabPane([
            ':key' => 'settings',
            ':active' => true
        ]);
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade show active"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithExplicitlyInactive()
    {
        $component = new TabPane([
            ':key' => 'settings',
            ':active' => false
        ]);
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithCustomClassAndActive()
    {
        $component = new TabPane([
            ':key' => 'settings',
            ':active' => true,
            'class' => 'text-bg-dark'
        ]);
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade show active text-bg-dark"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithUserDefinedIds()
    {
        $component = new TabPane([
            ':key' => 'settings',
            'id' => 'custom-pane-id',
            'aria-labelledby' => 'custom-tab-id'
        ]);
        $this->assertSame(
            '<div id="custom-pane-id"'
          .     ' class="tab-pane fade"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="custom-tab-id"'
          .     ' tabindex="0">'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithContent()
    {
        $component = new TabPane([
            ':key' => 'settings'
        ], 'Settings');
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          .     'Settings'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithMultipleContentElements()
    {
        $component = new TabPane([
            ':key' => 'settings'
        ], [
            '<h3>Settings</h3>',
            '<p>Manage your preferences here.</p>'
        ]);
        $this->assertSame(
            '<div id="pane-settings"'
          .     ' class="tab-pane fade"'
          .     ' role="tabpanel"'
          .     ' aria-labelledby="tab-settings"'
          .     ' tabindex="0">'
          .     '<h3>Settings</h3>'
          .     '<p>Manage your preferences here.</p>'
          . '</div>'
          , $component->Render()
        );
    }
}
