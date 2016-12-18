<?php

namespace Baguette\Response;

use Baguette\DummyApplication;
use Baguette\Response\ResponseInterface as BaguetteResponse;
use Baguette\Serializer;
use GuzzleHttp\Psr7;
use Nette\Mail\Message;
use Psr\Http\Message\MessageInterface;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class Helper_toPsr7Test extends \Baguette\TestCase
{
    /**
     * @param MessageInterface|Psr7\Response $expected
     * @dataProvider dataProviderFor_test
     */
    public function test(MessageInterface $expected, BaguetteResponse $bag_response)
    {
        $app = new DummyApplication([], [], [], []);
        /** @var MessageInterface|Psr7\Response $actual */
        $actual = Helper::toPsr7($app, $bag_response);

        $this->assertInstanceof(MessageInterface::class, $actual);

        $this->assertInstanceof(get_class($expected), $actual);
        if ($actual instanceof Psr7\Response) {
            $this->assertEquals($expected->getStatusCode(), $actual->getStatusCode());
        }
        $this->assertEquals($expected->getHeaders(), $actual->getHeaders());
        $this->assertEquals((string)$expected->getBody(), (string)$actual->getBody());
    }

    public function dataProviderFor_test()
    {
        return [
            [
                'expected' => new Psr7\Response(200, [
                    'content-type' => ['application/octet-stream'],
                ], Psr7\stream_for("Hello")),
                'bag_response' => new RawResponse("Hello"),
            ],
            [
                'expected' => new Psr7\Response(404, [
                    'content-type' => ['application/json; charset=utf-8'],
                ], '{"foo":"bar","fizz":"buzz"}'),
                'bag_response' => new SerializedResponse(
                    ['foo' => 'bar', 'fizz' => 'buzz'],
                    new Serializer\PhpJsonSerializer,
                    404
                ),
            ],
            [
                'expected' => new Psr7\Response(302, [
                    'location' => ['https://example.com/test?foo=bar&fizz=buzz'],
                ]),
                'bag_response' => new RedirectResponse('https://example.com/test', ['foo' => 'bar', 'fizz' => 'buzz']),
            ],
        ];
    }
}
