<?php

namespace Baguette\Response;

use Baguette\DummyApplication;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
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

        $this->assertSame($expected['header'], $redirect->getResponseHeaders());
        $this->assertSame($expected['body'],   $redirect->render($app));
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => [
                    'header' => [
                        'content-type' => ['text/plain'],
                    ],
                    'body' => "abcde"
                ],
                'body' => "abcde",
                'content_type' => "text/plain",
            ],
            [
                'expected' => [
                    'header' => [
                        'content-type' => ['application/octet-stream'],
                    ],
                    'body' => "abcde"
                ],
                'body' => "abcde",
                'content_type' => null,
            ],
        ];
    }
}
