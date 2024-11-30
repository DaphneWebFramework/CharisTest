<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;
use \PHPUnit\Framework\Attributes\DataProviderExternal;

use \Charis\Component;

use \TestToolkit\DataHelper;

class TestComponent extends Component
{
    public function __construct(
        string $tagName,
        array $attributes = [],
        string|Component|array|null $content = null,
        bool $isSelfClosing = false)
    {
        parent::__construct($tagName, $attributes, $content, $isSelfClosing);
    }
}

#[CoversClass(Component::class)]
class ComponentTest extends TestCase
{
    #region Valid Cases --------------------------------------------------------

    function testRenderWithNoAttributesOrContent()
    {
        $component = new TestComponent('div', [], null, false);
        $this->assertSame('<div></div>', $component->Render());
    }

    function testRenderWithEmptyAttributesButContent()
    {
        $component = new TestComponent('p', [], 'Hello, world!', false);
        $this->assertSame('<p>Hello, world!</p>', $component->Render());
    }

    function testRenderWithValidAttributesAndContent()
    {
        $component = new TestComponent(
            'div',
            ['id' => 'test', 'class' => 'example'],
            'Hello World',
            false
        );
        $this->assertSame(
            '<div id="test" class="example">Hello World</div>',
            $component->Render()
        );
    }

    function testRenderWithBooleanAttributes()
    {
        $component = new TestComponent(
            'input',
            ['type' => 'checkbox', 'checked' => true, 'disabled' => false],
            null,
            true
        );
        $this->assertSame(
            '<input type="checkbox" checked/>',
            $component->Render()
        );
    }

    function testRenderWithAttributesContainingSpecialCharacters()
    {
        $component = new TestComponent(
            'input',
            ['data-value' => 'John "Doe" & Co.'],
            null,
            true
        );
        $this->assertSame(
            '<input data-value="John &quot;Doe&quot; &amp; Co."/>',
            $component->Render()
        );
    }

    function testRenderWithAttributesHavingSpecialValues()
    {
        $component = new TestComponent(
            'input',
            ['data-count' => 0, 'data-ratio' => 1.425, 'data-blank' => ''],
            null,
            true
        );
        $this->assertSame(
            '<input data-count="0" data-ratio="1.425" data-blank=""/>',
            $component->Render()
        );
    }

    function testRenderWithAttributesHavingNonEnglishNames()
    {
        $component = new TestComponent(
            'div',
            ['данные' => 'значение'],
            null,
            false
        );
        $this->assertSame(
            '<div данные="значение"></div>',
            $component->Render()
        );
    }

    function testRenderWithAttributesHavingUnicodeValues()
    {
        $component = new TestComponent(
            'div',
            ['data-emoji' => '😊', 'lang' => '中文'],
            null,
            false
        );
        $this->assertSame('<div data-emoji="😊" lang="中文"></div>', $component->Render());
    }

    function testRenderWithSelfClosingElement()
    {
        $component = new TestComponent(
            'img',
            ['src' => 'image.jpg', 'alt' => 'A description'],
            null,
            true
        );
        $this->assertSame(
            '<img src="image.jpg" alt="A description"/>',
            $component->Render()
        );
    }

    function testRenderWithEmptySelfClosingElement()
    {
        $component = new TestComponent('br', [], null, true);
        $this->assertSame('<br/>', $component->Render());
    }

    function testRenderWithSelfClosingElementsInsideContent()
    {
        $component = new TestComponent(
            'div',
            [],
            [new TestComponent('br', [], null, true), 'Text after self-closing'],
            false
        );
        $this->assertSame(
            '<div><br/>Text after self-closing</div>',
            $component->Render()
        );
    }

    function testRenderWithContentContainingOnlyWhitespace()
    {
        $component = new TestComponent(
            'div',
            [],
            ['   ', new TestComponent('span', [], 'Text', false)],
            false
        );
        $this->assertSame(
            '<div>   <span>Text</span></div>',
            $component->Render()
        );
    }

    #[DataProvider('emptyContentProvider')]
    function testRenderWithEmptyContent($emptyContent)
    {
        $component = new TestComponent('div', [], $emptyContent, false);
        $this->assertSame('<div></div>', $component->Render());
    }

    function testRenderWithContentArray()
    {
        $component = new TestComponent(
            'div',
            [],
            ['Part 1', new TestComponent('span', [], 'Part 2', false)],
            false
        );
        $this->assertSame(
            '<div>Part 1<span>Part 2</span></div>',
            $component->Render()
        );
    }

    function testRenderWithNestedComponents()
    {
        $component = new TestComponent(
            'div',
            [],
            [
                'Outer Content',
                new TestComponent('span', [], [
                    'Inner Content',
                    new TestComponent('b', [], 'Bold Text', false)
                ], false)
            ],
            false
        );
        $this->assertSame(
            '<div>Outer Content<span>Inner Content<b>Bold Text</b></span></div>',
            $component->Render()
        );
    }

    #endregion Valid Cases

    #region Invalid Cases ------------------------------------------------------

    function testRenderThrowsForEmptyTagName()
    {
        $component = new TestComponent('', [], null, false);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');
        $component->Render();
    }

    function testRenderThrowsForInvalidTagName()
    {
        $component = new TestComponent('div#', [], null, false);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid tag name.');
        $component->Render();
    }

    #[DataProvider('invalidAttributeNameProvider')]
    function testRenderThrowsForInvalidAttributeName($attributeName)
    {
        $component = @new TestComponent(
            'div',
            [$attributeName => 'value'],
            null,
            false
        );
        $this->expectException(\InvalidArgumentException::class);
        if ($attributeName === null || $attributeName === '') {
            $this->expectExceptionMessage('Attribute name cannot be empty.');
        } else {
            $this->expectExceptionMessage('Attribute name must be a string.');
        }
        $component->Render();
    }

    #[DataProvider('invalidAttributeValueProvider')]
    function testRenderThrowsForInvalidAttributeValue($attributeValue)
    {
        $component = new TestComponent(
            'div',
            ['name' => $attributeValue],
            null,
            false
        );
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute value must be scalar.');
        $component->Render();
    }

    #[DataProviderExternal(DataHelper::class, 'NonStringProvider')]
    function testRenderThrowsForInvalidContentInArray($invalidContent)
    {
        $component = new TestComponent(
            'div',
            [],
            ['Some Content', new TestComponent('span'), $invalidContent],
            false
        );
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Content array must only contain strings or Component instances.');
        $component->Render();
    }

    function testRenderThrowsForSelfClosingComponentWithContent()
    {
        $component = new TestComponent(
            'img',
            ['src' => 'image.jpg'],
            'Some Content',
            true
        );
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'Self-closing components cannot have content.');
        $component->Render();
    }

    #endregion Invalid Cases

    #region Data Providers -----------------------------------------------------

    static function emptyContentProvider()
    {
        return [
            'empty string' => [''],
            'empty array' => [[]],
            'null' => [null]
        ];
    }

    static function invalidAttributeNameProvider()
    {
        return [
            'null' => [null],
            'boolean/true' => [true],
            'boolean/false' => [false],
            'integer' => [12345],
            'float' => [123.45],
            'string/empty' => ['']
        ];
    }

    static function invalidAttributeValueProvider()
    {
        return [
            'null' => [null],
            'array' => [["I'm", 'an', 'array']],
            'object' => [new \stdClass()],
            'callable' => [fn() => "I'm a callable"]
        ];
    }

    #endregion Data Providers
}
