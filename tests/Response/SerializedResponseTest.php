<?php

namespace Baguette\Response;

use Baguette\Serializer\PhpJsonSerializer;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class SerializedResponseTest extends \Baguette\TestCase
{
    public function test()
    {
        $app = new \Baguette\DummyApplication([], [], [], []);
        $response = new SerializedResponse(['a'], new PhpJsonSerializer);

        $expected_header = ['content-type' => ['application/json; charset=utf-8']];
        $expected_body = '["a"]';

        $this->assertSame($expected_header, $response->getResponseHeaders());
        $this->assertSame($expected_body, $response->render($app));
    }
}
