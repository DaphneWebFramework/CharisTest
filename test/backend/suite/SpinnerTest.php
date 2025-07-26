<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;

use \Charis\Spinner;

#[CoversClass(Spinner::class)]
class SpinnerTest extends TestCase
{
    function testDefaultRendering()
    {
        $component = new Spinner();
        $this->assertSame(
            '<div class="spinner-border" role="status">'
          .   '<span class="visually-hidden">Loading...</span>'
          . '</div>'
          , $component->Render()
        );
    }

    #[DataProvider('renderDataProvider')]
    function testRender(string $expectedClass, array $attributes): void
    {
        $component = new Spinner($attributes);
        $this->assertSame(
            "<div class=\"$expectedClass\" role=\"status\">"
          .   '<span class="visually-hidden">Loading...</span>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithLabel()
    {
        $component = new Spinner([':label' => 'Please wait']);
        $this->assertSame(
            '<div class="spinner-border" role="status">'
          .   '<span class="visually-hidden">Please wait</span>'
          . '</div>'
          , $component->Render()
        );
    }

    function testRenderWithColorClass()
    {
        $component = new Spinner(['class' => 'text-success']);
        $this->assertSame(
            '<div class="spinner-border text-success" role="status">'
          .   '<span class="visually-hidden">Loading...</span>'
          . '</div>'
          , $component->Render()
        );
    }

    #region Data Providers -----------------------------------------------------

    static function renderDataProvider()
    {
        return [
            'type:invalid' => [
                'spinner-border',
                [':type' => 'invalid']
            ],

            'type:border' => [
                'spinner-border',
                [':type' => 'border']
            ],
            'type:border size:sm' => [
                'spinner-border spinner-border-sm',
                [':type' => 'border', ':size' => 'sm']
            ],
            'type:border size:sm class:grow' => [
                'spinner-grow',
                [':type' => 'border', ':size' => 'sm', 'class' => 'spinner-grow']
            ],
            'type:border size:sm class:grow-sm' => [
                'spinner-grow-sm',
                [':type' => 'border', ':size' => 'sm', 'class' => 'spinner-grow-sm']
            ],
            'type:border size:sm class:border' => [
                'spinner-border spinner-border-sm',
                [':type' => 'border', ':size' => 'sm', 'class' => 'spinner-border']
            ],
            'type:border size:sm class:border-sm' => [
                'spinner-border spinner-border-sm',
                [':type' => 'border', ':size' => 'sm', 'class' => 'spinner-border-sm']
            ],
            'type:border class:grow' => [
                'spinner-grow',
                [':type' => 'border', 'class' => 'spinner-grow']
            ],
            'type:border class:grow-sm' => [
                'spinner-grow-sm',
                [':type' => 'border', 'class' => 'spinner-grow-sm']
            ],
            'type:border class:border' => [
                'spinner-border',
                [':type' => 'border', 'class' => 'spinner-border']
            ],
            'type:border class:border-sm' => [
                'spinner-border spinner-border-sm',
                [':type' => 'border', 'class' => 'spinner-border-sm']
            ],

            'type:grow' => [
                'spinner-grow',
                [':type' => 'grow']
            ],
            'type:grow size:sm' => [
                'spinner-grow-sm spinner-grow',
                [':type' => 'grow', ':size' => 'sm']
            ],
            'type:grow size:sm class:grow' => [
                'spinner-grow-sm spinner-grow',
                [':type' => 'grow', ':size' => 'sm', 'class' => 'spinner-grow']
            ],
            'type:grow size:sm class:grow-sm' => [
                'spinner-grow-sm spinner-grow',
                [':type' => 'grow', ':size' => 'sm', 'class' => 'spinner-grow-sm']
            ],
            'type:grow size:sm class:border' => [
                'spinner-border',
                [':type' => 'grow', ':size' => 'sm', 'class' => 'spinner-border']
            ],
            'type:grow size:sm class:border-sm' => [
                'spinner-border-sm',
                [':type' => 'grow', ':size' => 'sm', 'class' => 'spinner-border-sm']
            ],
            'type:grow class:grow' => [
                'spinner-grow',
                [':type' => 'grow', 'class' => 'spinner-grow']
            ],
            'type:grow class:grow-sm' => [
                'spinner-grow-sm spinner-grow',
                [':type' => 'grow', 'class' => 'spinner-grow-sm']
            ],
            'type:grow class:border' => [
                'spinner-border',
                [':type' => 'grow', 'class' => 'spinner-border']
            ],
            'type:grow class:border-sm' => [
                'spinner-border-sm',
                [':type' => 'grow', 'class' => 'spinner-border-sm']
            ],

            'size:invalid' => [
                'spinner-border',
                [':size' => 'invalid']
            ],

            'size:sm' => [
                'spinner-border spinner-border-sm',
                [':size' => 'sm']
            ],
            'size:sm class:grow' => [
                'spinner-grow',
                [':size' => 'sm', 'class' => 'spinner-grow']
            ],
            'size:sm class:grow-sm' => [
                'spinner-grow-sm',
                [':size' => 'sm', 'class' => 'spinner-grow-sm']
            ],
            'size:sm class:border' => [
                'spinner-border spinner-border-sm',
                [':size' => 'sm', 'class' => 'spinner-border']
            ],
            'size:sm class:border-sm' => [
                'spinner-border spinner-border-sm',
                [':size' => 'sm', 'class' => 'spinner-border-sm']
            ],

            'class:grow' => [
                'spinner-grow',
                ['class' => 'spinner-grow']
            ],
            'class:grow-sm' => [
                'spinner-grow-sm',
                ['class' => 'spinner-grow-sm']
            ],
            'class:border' => [
                'spinner-border',
                ['class' => 'spinner-border']
            ],
            'class:border-sm' => [
                'spinner-border spinner-border-sm',
                ['class' => 'spinner-border-sm']
            ],

            'class:border grow' => [
                'spinner-border',
                ['class' => 'spinner-border spinner-grow']
            ],
            'class:border grow-sm' => [
                'spinner-border',
                ['class' => 'spinner-border spinner-grow-sm']
            ],
            'class:border-sm grow' => [
                'spinner-border-sm',
                ['class' => 'spinner-border-sm spinner-grow']
            ],
            'class:border-sm grow-sm' => [
                'spinner-border-sm',
                ['class' => 'spinner-border-sm spinner-grow-sm']
            ],
            'class:grow border' => [
                'spinner-grow',
                ['class' => 'spinner-grow spinner-border']
            ],
            'class:grow border-sm' => [
                'spinner-grow',
                ['class' => 'spinner-grow spinner-border-sm']
            ],
            'class:grow-sm border' => [
                'spinner-grow-sm',
                ['class' => 'spinner-grow-sm spinner-border']
            ],
            'class:grow-sm border-sm' => [
                'spinner-grow-sm',
                ['class' => 'spinner-grow-sm spinner-border-sm']
            ],
        ];
    }

    #endregion Data Providers
}
