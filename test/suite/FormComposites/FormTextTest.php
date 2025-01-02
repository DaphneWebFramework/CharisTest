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
        $formText = new FormText();
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text"/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithId()
    {
        $formText = new FormText([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $formText = new FormText([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label class="form-label" for="form-input-UID">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID"/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $formText = new FormText([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label class="form-label" for="custom-id">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id"/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $formText = new FormText([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $formText = new FormText([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label class="form-label" for="form-input-UID">Label Text</label>'
          .   '<input class="form-control" type="text" id="form-input-UID" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $formText = new FormText([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label class="form-label" for="custom-id">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id" aria-describedby="form-help-text-UID"/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithPlaceholder()
    {
        $formText = new FormText([':placeholder' => 'Placeholder text']);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" placeholder="Placeholder text"/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithDisabled()
    {
        $formText = new FormText([':disabled' => true]);
        $this->assertSame(
            '<div class="mb-3">'
          .   '<input class="form-control" type="text" disabled/>'
          . '</div>'
          , $formText->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $formText = new FormText([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':placeholder' => 'Placeholder text',
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="mb-3">'
          .   '<label class="form-label" for="custom-id">Label Text</label>'
          .   '<input class="form-control" type="text" id="custom-id" aria-describedby="form-help-text-UID" placeholder="Placeholder text" disabled/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $formText->Render()
        );
    }
}
