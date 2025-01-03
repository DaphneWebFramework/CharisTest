<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\FormComposites\FormFLText;

#[CoversClass(FormFLText::class)]
class FormFLTextTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new FormFLText();
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithId()
    {
        $component = new FormFLText([':id' => 'custom-id']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="custom-id" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithName()
    {
        $component = new FormFLText([':name' => 'Text1']);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" name="Text1" placeholder=""/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelText()
    {
        $component = new FormFLText([':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="form-input-UID" placeholder=""/>'
          .   '<label for="form-input-UID">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelText()
    {
        $component = new FormFLText([':id' => 'custom-id', ':label-text' => 'Label Text']);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="custom-id" placeholder=""/>'
          .   '<label for="custom-id">Label Text</label>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithHelpText()
    {
        $component = new FormFLText([':help-text' => 'This is a help text.']);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" aria-describedby="form-help-text-UID" placeholder=""/>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabelTextAndHelpText()
    {
        $component = new FormFLText([
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="form-input-UID" aria-describedby="form-help-text-UID" placeholder=""/>'
          .   '<label for="form-input-UID">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithIdAndLabelTextAndHelpText()
    {
        $component = new FormFLText([
            ':id' => 'custom-id',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="custom-id" aria-describedby="form-help-text-UID" placeholder=""/>'
          .   '<label for="custom-id">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderThrowsWithPlaceholder()
    {
        $component = new FormFLText([':placeholder' => 'Placeholder text']);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid attribute name.');
        $component->Render();
    }

    function testRenderWithDisabled()
    {
        $component = new FormFLText([':disabled' => true]);
        $this->assertSame(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" placeholder="" disabled/>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithAllPseudoAttributes()
    {
        $component = new FormFLText([
            ':id' => 'custom-id',
            ':name' => 'Text1',
            ':label-text' => 'Label Text',
            ':help-text' => 'This is a help text.',
            ':disabled' => true,
        ]);
        $this->assertMatchesWithUID(
            '<div class="form-floating mb-3">'
          .   '<input class="form-control" type="text" id="custom-id" name="Text1" aria-describedby="form-help-text-UID" placeholder="" disabled/>'
          .   '<label for="custom-id">Label Text</label>'
          .   '<div id="form-help-text-UID" class="form-text">This is a help text.</div>'
          . '</div>'
          , $component->Render()
        );
    }
}
