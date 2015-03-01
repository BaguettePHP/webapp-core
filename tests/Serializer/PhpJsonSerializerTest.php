<?php
namespace Baguette\Serializer;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class PhpJsonSerializerTest extends \Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_test
     */
    public function test($expected, $input, $encode_option, $empty_as_object)
    {
        $json = new PhpJsonSerializer($encode_option);

        $this->assertInstanceOf('\Baguette\Serializer\PhpJsonSerializer', $json->setEmptyAsObject($empty_as_object));
        $this->assertSame($expected, $json->serialize($input));
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => '["a","b"]',
                'input'    => ['a', 'b'],
                'encode_option' => null,
                'empty_as_object' => false,
            ],
            [
                'expected' => '["a","b"]',
                'input'    => ['a', 'b'],
                'encode_option' => null,
                'empty_as_object' => true,
            ],
            [
                'expected' => '["a"]',
                'input'    => [0 => 'a'],
                'encode_option' => null,
                'empty_as_object' => true,
            ],
            [
                'expected' => '{"1":"a"}',
                'input'    => [1 => 'a'],
                'encode_option' => null,
                'empty_as_object' => true,
            ],
            [
                'expected' => '[]',
                'input'    => [],
                'encode_option' => null,
                'empty_as_object' => false,
            ],
            [
                'expected' => '{}',
                'input'    => [],
                'encode_option' => null,
                'empty_as_object' => true,
            ],
            [
                'expected' => '["키"]',
                'input'    => ['키'],
                'encode_option' => null,
                'empty_as_object' => true,
            ],
            [
                'expected' => '["\ud0a4"]',
                'input'    => ['키'],
                'encode_option' => 0,
                'empty_as_object' => true,
            ],
            [
                'expected' => '[false]',
                'input'    => [false],
                'encode_option' => 0,
                'empty_as_object' => true,
            ],
            [
                'expected' => '[true]',
                'input'    => [true],
                'encode_option' => 0,
                'empty_as_object' => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_test_raise_DomainException
     */
    public function test_raise_DomainException($expected, $input)
    {
        $json = new PhpJsonSerializer;

        $this->setExpectedException('\DomainException', $expected);
        $json->serialize($input);
    }

    public function dataProviderFor_test_raise_DomainException()
    {
        return [
            [
                'expected' => 'JSON_ERROR_UNSUPPORTED_TYPE',
                'input' => fopen('php://stdout', 'r'),
            ],
        ];
    }
}
