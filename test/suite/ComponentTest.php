<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;
use \PHPUnit\Framework\Attributes\DataProviderExternal;

use \Charis\Component;

use \TestToolkit\DataHelper;

#[CoversClass(Component::class)]
class ComponentTest extends TestCase
{
    function testToStringCallsRender()
    {
        $mock = $this->getMockBuilder(Component::class)
            ->setConstructorArgs(['div'])
            ->onlyMethods(['Render'])
            ->getMock();
        $mock->expects($this->once())
            ->method('Render')
            ->willReturn('<div></div>');
        $this->assertSame('<div></div>', (string)$mock);
    }

    #region Valid Cases --------------------------------------------------------

    function testRenderWithNoAttributesOrContent()
    {
        $component = new Component('div');
        $this->assertSame('<div></div>', $component->Render());
    }

    function testRenderWithEmptyAttributesButContent()
    {
        $component = new Component('p', null, 'Hello, world!');
        $this->assertSame('<p>Hello, world!</p>', $component->Render());
    }

    function testRenderWithValidAttributesAndContent()
    {
        $component = new Component(
            'div',
            ['id' => 'test', 'class' => 'example'],
            'Hello World'
        );
        $this->assertSame(
            '<div id="test" class="example">Hello World</div>',
            $component->Render()
        );
    }

    function testRenderWithBooleanAttributes()
    {
        $component = new Component(
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
        $component = new Component(
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
        $component = new Component(
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

    function testRenderWithAttributesHavingUnicodeValues()
    {
        $component = new Component('div', ['data-emoji' => '😊', 'lang' => '中文']);
        $this->assertSame('<div data-emoji="😊" lang="中文"></div>', $component->Render());
    }

    function testRenderWithSelfClosingElement()
    {
        $component = new Component(
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
        $component = new Component('br', null, null, true);
        $this->assertSame('<br/>', $component->Render());
    }

    function testRenderWithSelfClosingElementsInsideContent()
    {
        $component = new Component(
            'div',
            null,
            [new Component('br', null, null, true), 'Text after self-closing']
        );
        $this->assertSame(
            '<div><br/>Text after self-closing</div>',
            $component->Render()
        );
    }

    function testRenderWithContentContainingOnlyWhitespace()
    {
        $component = new Component(
            'div',
            null,
            ['   ', new Component('span', null, 'Text')]
        );
        $this->assertSame(
            '<div>   <span>Text</span></div>',
            $component->Render()
        );
    }

    #[DataProvider('emptyContentProvider')]
    function testRenderWithEmptyContent($emptyContent)
    {
        $component = new Component('div', null, $emptyContent);
        $this->assertSame('<div></div>', $component->Render());
    }

    function testRenderWithContentArray()
    {
        $component = new Component(
            'div',
            null,
            ['Part 1', new Component('span', null, 'Part 2')]
        );
        $this->assertSame(
            '<div>Part 1<span>Part 2</span></div>',
            $component->Render()
        );
    }

    function testRenderWithNestedComponents()
    {
        $component = new Component(
            'div',
            null,
            [
                'Outer Content',
                new Component('span', null, [
                    'Inner Content',
                    new Component('b', null, 'Bold Text')
                ])
            ]
        );
        $this->assertSame(
            '<div>Outer Content<span>Inner Content<b>Bold Text</b></span></div>',
            $component->Render()
        );
    }

    #endregion Valid Cases

    #region Invalid Cases ------------------------------------------------------

    #[DataProvider('invalidTagNameProvider')]
    function testRenderThrowsForInvalidTagName($tagName)
    {
        $component = new Component($tagName);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid tag name.');
        $component->Render();
    }

    #[DataProvider('nonStringAttributeNameProvider')]
    function testRenderThrowsForNonStringAttributeName($attributeName)
    {
        // Suppress warnings caused by non-string keys (e.g., float key being
        // converted to integers). This ensures the test results are not
        // polluted with PHP warnings.
        $component = @new Component('div', [$attributeName => 'value']);
        $this->expectException(\InvalidArgumentException::class);
        if ($attributeName === null) {
            // PHP automatically converts null array keys to empty strings,
            // bypassing type mismatch checks. This manual null check ensures
            // proper validation.
            $this->expectExceptionMessage('Invalid attribute name.');
        } else {
            $this->expectExceptionMessage('Attribute name must be a string.');
        }
        $component->Render();
    }

    #[DataProvider('invalidAttributeNameProvider')]
    function testRenderThrowsForInvalidAttributeName($attributeName)
    {
        $component = new Component('div', [$attributeName => 'value']);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid attribute name.');
        $component->Render();
    }

    #[DataProvider('nonScalarAttributeValueProvider')]
    function testRenderThrowsForNonScalarAttributeValue($attributeValue)
    {
        $component = new Component('div', ['name' => $attributeValue]);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute value must be scalar.');
        $component->Render();
    }

    #[DataProviderExternal(DataHelper::class, 'NonStringProvider')]
    function testRenderThrowsForInvalidContentInArray($invalidContent)
    {
        $component = new Component(
            'div',
            null,
            ['Some Content', new Component('span'), $invalidContent]
        );
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Content array must only contain strings or Component instances.');
        $component->Render();
    }

    function testRenderThrowsForSelfClosingComponentWithContent()
    {
        $component = new Component(
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

    static function invalidTagNameProvider()
    {
        return [
            'empty string' => [''],
            'a number at start' => ['1div'],
            'an underscore at start' => ['_div'],
            'a space inside' => ['div tag'],
            'a colon inside' => ['div:tag'],
            'a period inside' => ['div.tag'],
            'an underscore inside' => ['div_tag'],
            'a hash symbol at end' => ['div#'],
            'an at symbol at end' => ['div@'],
            'a single invalid character' => ['#'],
            'multiple invalid characters' => ['#@!'],
        ];
    }

    static function nonStringAttributeNameProvider()
    {
        return [
            'null' => [null],
            'boolean/true' => [true],
            'boolean/false' => [false],
            'integer' => [12345],
            'float' => [123.45]
        ];
    }

    static function invalidAttributeNameProvider()
    {
        return [
            'empty string' => [''],
            'a number at start' => ['1attr'],
            'a space inside' => ['attr name'],
            'a hash symbol inside' => ['attr#name'],
            'an at symbol inside' => ['attr@name'],
            'a special character at end' => ['attr$'],
            'starts with a special character' => ['%attr'],
            'contains invalid characters' => ['attr!name'],
            'multiple invalid characters' => ['#@!'],
        ];
    }

    static function nonScalarAttributeValueProvider()
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
