<?php
namespace Baguette\Response;
use Baguette\DummyApplication;

/**
 * @package   Baguette\Redirect
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class RedirectResponseTest extends \Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_test
     */
    public function test($expected, $location, array $param, $status)
    {
        $app = new DummyApplication([], [], [], []);
        $redirect = new RedirectResponse($location, $param, $status);

        $this->assertSame($expected, $redirect->getResponseHeaders($app));
        $this->assertNull($redirect->render($app));
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => [
                    ['Location: http://example.com/', true, 302]
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => null,
            ],
            [
                'expected' => [
                    ['Location: http://example.com/?foo=bar', true, 302]
                ],
                'location' => 'http://example.com/',
                'param'    => ['foo' => 'bar'],
                'status'   => null,
            ],
            [
                'expected' => [
                    ['Location: http://example.com/?foo%5B0%5D=bar', true, 302]
                ],
                'location' => 'http://example.com/',
                'param'    => ['foo' => ['bar']],
                'status'   => null,
            ],
            [
                'expected' => [
                    ['Location: http://example.com/', true, 301]
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => 301,
            ],
            [
                'expected' => [
                    ['Location: http://example.com/', true, 302]
                ],
                'location' => 'http://example.com/',
                'param'    => [],
                'status'   => 302,
            ],
        ];
    }
}
