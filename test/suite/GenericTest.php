<?php declare(strict_types=1);
use \PHPUnit\Framework\TestCase;
use \PHPUnit\Framework\Attributes\CoversClass;
use \PHPUnit\Framework\Attributes\DataProvider;
use \PHPUnit\Framework\Attributes\DataProviderExternal;

use \Charis\Generic;

use \TestToolkit\DataHelper;

#[CoversClass(Generic::class)]
class GenericTest extends TestCase
{
    function testToStringCallsRender()
    {
        $mock = $this->getMockBuilder(Generic::class)
            ->setConstructorArgs(['div'])
            ->onlyMethods(['Render'])
            ->getMock();
        $mock->expects($this->once())
            ->method('Render')
            ->willReturn('<div></div>');
        $this->assertSame('<div></div>', (string)$mock);
    }

    function testRenderWithNoAttributesOrContent()
    {
        $generic = new Generic('div');
        $this->assertSame('<div></div>', $generic->Render());
    }

    function testRenderWithEmptyAttributesButContent()
    {
        $generic = new Generic('p', null, 'Hello, world!');
        $this->assertSame('<p>Hello, world!</p>', $generic->Render());
    }

    function testRenderWithValidAttributesAndContent()
    {
        $generic = new Generic(
            'div',
            ['id' => 'test', 'class' => 'example'],
            'Hello World'
        );
        $this->assertSame(
            '<div id="test" class="example">Hello World</div>',
            $generic->Render()
        );
    }

    function testRenderWithBooleanAttributes()
    {
        $generic = new Generic(
            'input',
            ['type' => 'checkbox', 'checked' => true, 'disabled' => false],
            null,
            true
        );
        $this->assertSame(
            '<input type="checkbox" checked/>',
            $generic->Render()
        );
    }

    function testRenderWithAttributesContainingSpecialCharacters()
    {
        $generic = new Generic(
            'input',
            ['data-value' => 'John "Doe" & Co.'],
            null,
            true
        );
        $this->assertSame(
            '<input data-value="John &quot;Doe&quot; &amp; Co."/>',
            $generic->Render()
        );
    }

    function testRenderWithAttributesHavingSpecialValues()
    {
        $generic = new Generic(
            'input',
            ['data-count' => 0, 'data-ratio' => 1.425, 'data-blank' => ''],
            null,
            true
        );
        $this->assertSame(
            '<input data-count="0" data-ratio="1.425" data-blank=""/>',
            $generic->Render()
        );
    }

    function testRenderWithAttributesHavingUnicodeValues()
    {
        $generic = new Generic('div', ['data-emoji' => '😊', 'lang' => '中文']);
        $this->assertSame('<div data-emoji="😊" lang="中文"></div>', $generic->Render());
    }

    function testRenderWithSelfClosingElement()
    {
        $generic = new Generic(
            'img',
            ['src' => 'image.jpg', 'alt' => 'A description'],
            null,
            true
        );
        $this->assertSame(
            '<img src="image.jpg" alt="A description"/>',
            $generic->Render()
        );
    }

    function testRenderWithEmptySelfClosingElement()
    {
        $generic = new Generic('br', null, null, true);
        $this->assertSame('<br/>', $generic->Render());
    }

    function testRenderWithSelfClosingElementsInsideContent()
    {
        $generic = new Generic(
            'div',
            null,
            [new Generic('br', null, null, true), 'Text after self-closing']
        );
        $this->assertSame(
            '<div><br/>Text after self-closing</div>',
            $generic->Render()
        );
    }

    function testRenderWithContentContainingOnlyWhitespace()
    {
        $generic = new Generic(
            'div',
            null,
            ['   ', new Generic('span', null, 'Text')]
        );
        $this->assertSame(
            '<div>   <span>Text</span></div>',
            $generic->Render()
        );
    }

    #[DataProvider('emptyContentProvider')]
    function testRenderWithEmptyContent($emptyContent)
    {
        $generic = new Generic('div', null, $emptyContent);
        $this->assertSame('<div></div>', $generic->Render());
    }

    function testRenderWithContentArray()
    {
        $generic = new Generic(
            'div',
            null,
            ['Part 1', new Generic('span', null, 'Part 2')]
        );
        $this->assertSame(
            '<div>Part 1<span>Part 2</span></div>',
            $generic->Render()
        );
    }

    function testRenderWithNestedComponents()
    {
        $generic = new Generic(
            'div',
            null,
            [
                'Outer Content',
                new Generic('span', null, [
                    'Inner Content',
                    new Generic('b', null, 'Bold Text')
                ])
            ]
        );
        $this->assertSame(
            '<div>Outer Content<span>Inner Content<b>Bold Text</b></span></div>',
            $generic->Render()
        );
    }

    #[DataProvider('invalidTagNameProvider')]
    function testRenderThrowsForInvalidTagName($tagName)
    {
        $generic = new Generic($tagName);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid tag name.');
        $generic->Render();
    }

    #[DataProvider('nonStringAttributeNameProvider')]
    function testRenderThrowsForNonStringAttributeName($attributeName)
    {
        // Suppress warnings caused by non-string keys (e.g., float key being
        // converted to integers). This ensures the test results are not
        // polluted with PHP warnings.
        $generic = @new Generic('div', [$attributeName => 'value']);
        $this->expectException(\InvalidArgumentException::class);
        if ($attributeName === null) {
            // PHP automatically converts null array keys to empty strings,
            // bypassing type mismatch checks. This manual null check ensures
            // proper validation.
            $this->expectExceptionMessage('Invalid attribute name.');
        } else {
            $this->expectExceptionMessage('Attribute name must be a string.');
        }
        $generic->Render();
    }

    #[DataProvider('invalidAttributeNameProvider')]
    function testRenderThrowsForInvalidAttributeName($attributeName)
    {
        $generic = new Generic('div', [$attributeName => 'value']);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid attribute name.');
        $generic->Render();
    }

    #[DataProvider('nonScalarAttributeValueProvider')]
    function testRenderThrowsForNonScalarAttributeValue($attributeValue)
    {
        $generic = new Generic('div', ['name' => $attributeValue]);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute value must be scalar.');
        $generic->Render();
    }

    #[DataProviderExternal(DataHelper::class, 'NonStringProvider')]
    function testRenderThrowsForInvalidContentInArray($invalidContent)
    {
        $generic = new Generic(
            'div',
            null,
            ['Some Content', new Generic('span'), $invalidContent]
        );
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Content array must only contain strings or Component instances.');
        $generic->Render();
    }

    function testRenderThrowsForSelfClosingComponentWithContent()
    {
        $generic = new Generic(
            'img',
            ['src' => 'image.jpg'],
            'Some Content',
            true
        );
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'Self-closing components cannot have content.');
        $generic->Render();
    }

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
