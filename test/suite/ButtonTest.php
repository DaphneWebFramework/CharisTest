<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\DataProvider;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Button;

#[CoversClass(Button::class)]
class ButtonTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Button();
        $this->assertSame(
            '<button type="button" class="btn btn-primary">'
          . '</button>'
          , $component->Render()
        );
    }

    #[DataProvider('variantProvider')]
    function testRenderVariant($expected, $attributes, $content)
    {
        $component = new Button($attributes, $content);
        $this->assertSame($expected, $component->Render());
    }

    #[DataProvider('sizeProvider')]
    function testRenderSize($expected, $attributes, $content)
    {
        $component = new Button($attributes, $content);
        $this->assertSame($expected, $component->Render());
    }

    #region Data Providers -----------------------------------------------------

    static function variantProvider()
    {
        return [
            [
                '<button type="button" class="btn btn-secondary">Secondary</button>',
                ['class' => 'btn-secondary'],
                'Secondary',
            ],
            [
                '<button type="button" class="btn btn-success">Success</button>',
                ['class' => 'btn-success'],
                'Success',
            ],
            [
                '<button type="button" class="btn btn-info">Info</button>',
                ['class' => 'btn-info'],
                'Info',
            ],
            [
                '<button type="button" class="btn btn-warning">Warning</button>',
                ['class' => 'btn-warning'],
                'Warning',
            ],
            [
                '<button type="button" class="btn btn-danger">Danger</button>',
                ['class' => 'btn-danger'],
                'Danger',
            ],
            [
                '<button type="button" class="btn btn-light">Light</button>',
                ['class' => 'btn-light'],
                'Light',
            ],
            [
                '<button type="button" class="btn btn-dark">Dark</button>',
                ['class' => 'btn-dark'],
                'Dark',
            ],
            [
                '<button type="button" class="btn btn-link">Link</button>',
                ['class' => 'btn-link'],
                'Link',
            ],
            [
                '<button type="button" class="btn btn-outline-primary">Primary</button>',
                ['class' => 'btn-outline-primary'],
                'Primary',
            ],
            [
                '<button type="button" class="btn btn-outline-secondary">Secondary</button>',
                ['class' => 'btn-outline-secondary'],
                'Secondary',
            ],
            [
                '<button type="button" class="btn btn-outline-success">Success</button>',
                ['class' => 'btn-outline-success'],
                'Success',
            ],
            [
                '<button type="button" class="btn btn-outline-info">Info</button>',
                ['class' => 'btn-outline-info'],
                'Info',
            ],
            [
                '<button type="button" class="btn btn-outline-warning">Warning</button>',
                ['class' => 'btn-outline-warning'],
                'Warning',
            ],
            [
                '<button type="button" class="btn btn-outline-danger">Danger</button>',
                ['class' => 'btn-outline-danger'],
                'Danger',
            ],
            [
                '<button type="button" class="btn btn-outline-light">Light</button>',
                ['class' => 'btn-outline-light'],
                'Light',
            ],
            [
                '<button type="button" class="btn btn-outline-dark">Dark</button>',
                ['class' => 'btn-outline-dark'],
                'Dark',
            ],
        ];
    }

    static function sizeProvider()
    {
        return [
            [
                '<button type="button" class="btn-sm btn btn-primary">Small button</button>',
                ['class' => 'btn-sm'],
                'Small button',
            ],
            [
                '<button type="button" class="btn-lg btn btn-primary">Large button</button>',
                ['class' => 'btn-lg'],
                'Large button',
            ],
        ];
    }

    #endregion Data Providers
}
