<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;

use \Charis\Button;

#[CoversClass(Button::class)]
class ButtonTest extends TestCase
{
    function testDefaultRendering()
    {
        $button = new Button();
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-primary"></button>'
        );
    }

    function testRenderVariants()
    {
        $button = new Button(['class' => 'btn-secondary'], 'Secondary');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-secondary">Secondary</button>'
        );
        $button = new Button(['class' => 'btn-success'], 'Success');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-success">Success</button>'
        );
        $button = new Button(['class' => 'btn-info'], 'Info');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-info">Info</button>'
        );
        $button = new Button(['class' => 'btn-warning'], 'Warning');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-warning">Warning</button>'
        );
        $button = new Button(['class' => 'btn-danger'], 'Danger');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-danger">Danger</button>'
        );
        $button = new Button(['class' => 'btn-light'], 'Light');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-light">Light</button>'
        );
        $button = new Button(['class' => 'btn-dark'], 'Dark');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-dark">Dark</button>'
        );
        $button = new Button(['class' => 'btn-link'], 'Link');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-link">Link</button>'
        );
        $button = new Button(['class' => 'btn-outline-primary'], 'Primary');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-primary">Primary</button>'
        );
        $button = new Button(['class' => 'btn-outline-secondary'], 'Secondary');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-secondary">Secondary</button>'
        );
        $button = new Button(['class' => 'btn-outline-success'], 'Success');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-success">Success</button>'
        );
        $button = new Button(['class' => 'btn-outline-info'], 'Info');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-info">Info</button>'
        );
        $button = new Button(['class' => 'btn-outline-warning'], 'Warning');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-warning">Warning</button>'
        );
        $button = new Button(['class' => 'btn-outline-danger'], 'Danger');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-danger">Danger</button>'
        );
        $button = new Button(['class' => 'btn-outline-light'], 'Light');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-light">Light</button>'
        );
        $button = new Button(['class' => 'btn-outline-dark'], 'Dark');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn btn-outline-dark">Dark</button>'
        );
    }

    function testRenderSizes()
    {
        $button = new Button(['class'=>'btn-sm'], 'Small button');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn-sm btn btn-primary">Small button</button>'
        );
        $button = new Button(['class'=>'btn-lg'], 'Large button');
        $this->assertSame(
            $button->Render(),
            '<button type="button" class="btn-lg btn btn-primary">Large button</button>'
        );
    }
}
