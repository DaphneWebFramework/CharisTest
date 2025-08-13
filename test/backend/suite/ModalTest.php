<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Modal;

use \Charis\Button;

#[CoversClass(Modal::class)]
class ModalTest extends TestCase
{
    private function assertMatchesWithUID(string $expected, string $actual): void
    {
        $expected = str_replace('UID', '[a-z0-9]{13}', preg_quote($expected, '/'));
        $this->assertMatchesRegularExpression("/^{$expected}\$/", $actual);
    }

    function testDefaultRendering()
    {
        $component = new Modal();
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
          .         '<button type="button" class="btn btn-primary">Save changes</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithTitle()
    {
        $component = new Modal([':title' => 'My Modal']);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID">My Modal</h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
          .         '<button type="button" class="btn btn-primary">Save changes</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithBody()
    {
        $component = new Modal([':body' => 'This is the body content.']);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .         'This is the body content.'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
          .         '<button type="button" class="btn btn-primary">Save changes</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithSecondaryButtonLabel()
    {
        $component = new Modal([':secondary-button-label' => 'Cancel']);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>'
          .         '<button type="button" class="btn btn-primary">Save changes</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithPrimaryButtonLabel()
    {
        $component = new Modal([':primary-button-label' => 'Upload File']);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
          .         '<button type="button" class="btn btn-primary">Upload File</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithFooter()
    {
        $component = new Modal([
            ':footer' => [
                new Button(['class' => 'btn-danger'], 'Delete')
            ]
        ]);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-danger">Delete</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithDialogClassCentered()
    {
        $component = new Modal([':dialog:class' => 'modal-dialog-centered']);
        $this->assertMatchesWithUID(
            '<div class="modal" aria-hidden="true" aria-labelledby="modal-title-UID" tabindex="-1">'
          .   '<div class="modal-dialog modal-dialog-centered">'
          .     '<div class="modal-content">'
          .       '<div class="modal-header">'
          .         '<h5 class="modal-title" id="modal-title-UID"></h5>'
          .         '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
          .       '</div>'
          .       '<div class="modal-body">'
          .       '</div>'
          .       '<div class="modal-footer">'
          .         '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
          .         '<button type="button" class="btn btn-primary">Save changes</button>'
          .       '</div>'
          .     '</div>'
          .   '</div>'
          . '</div>',
            $component->Render()
        );
    }
}
