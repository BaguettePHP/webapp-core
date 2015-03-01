<?php
namespace Baguette\Response;
use Baguette\DummyApplication;

/**
 * @package   Baguette\Redirect
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class RawResponseTest extends \Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_test
     */
    public function test(array $expected, $body, $content_type)
    {
        $app = new DummyApplication([], [], [], []);
        $redirect = new RawResponse($body, $content_type);

        $this->assertSame($expected['header'], $redirect->getResponseHeaders($app));
        $this->assertSame($expected['body'],   $redirect->render($app));
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => [
                    'header' => [
                        ['Content-Type: text/plain'],
                    ],
                    'body' => "abcde"
                ],
                'body' => "abcde",
                'content_type' => "text/plain",
            ],
            [
                'expected' => [
                    'header' => [
                        ['Content-Type: application/octet-stream'],
                    ],
                    'body' => "abcde"
                ],
                'body' => "abcde",
                'content_type' => null,
            ],
        ];
    }
}
