<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormText;

#[CoversClass(FormText::class)]
class FormTextTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormText();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithId()
    {
        $component = new FormText([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithName()
    {
        $component = new FormText([':name' => 'Text1']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" name="Text1"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $component = new FormText([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="form-input-UID" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $component = new FormText([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $component = new FormText([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $component = new FormText([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="form-input-UID" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $component = new FormText([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithPlaceholder()
    {
        $component = new FormText([':placeholder' => 'Placeholder text']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" placeholder="Placeholder text"/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $component = new FormText([':disabled' => true]);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormText([
            ':id' => 'custom-id',
            ':name' => 'Text1',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':placeholder' => 'Placeholder text',
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label for="custom-id" class="form-label">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id" name="Text1" aria-describedby="form-help-text-UID" placeholder="Placeholder text" disabled/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
