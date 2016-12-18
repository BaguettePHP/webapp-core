<?php

namespace Baguette\Response;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class RedirectResponseTest extends \Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_test
     */
    public function test($expected, $location, array $param, $status)
    {
        $app = new \Baguette\DummyApplication([], [], [], []);
        $redirect = new RedirectResponse($location, $param, $status);

        $this->assertSame($expected, $redirect->getResponseHeaders());
        $this->assertNull($redirect->render($app));
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => [
                    'location' => ['http://example.com/']
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => null,
            ],
            [
                'expected' => [
                    'location' => ['http://example.com/?foo=bar']
                ],
                'location' => 'http://example.com/',
                'param'    => ['foo' => 'bar'],
                'status'   => null,
            ],
            [
                'expected' => [
                    'location' => ['http://example.com/?foo%5B0%5D=bar']
                ],
                'location' => 'http://example.com/',
                'param'    => ['foo' => ['bar']],
                'status'   => null,
            ],
            [
                'expected' => [
                    'location' => ['http://example.com/']
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => 301,
            ],
            [
                'expected' => [
                    'location' => ['http://example.com/']
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => 302,
            ],
        ];
    }
}
