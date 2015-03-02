<?php
namespace Baguette\Response;
use Baguette\DummyApplication;
use Baguette\Serializer\PhpJsonSerializer;

/**
 * @package   Baguette\Redirect
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class SerializedResponseTest extends \Baguette\TestCase
{
    public function test()
    {
        $app = new DummyApplication([], [], [], []);
        $serializer = new PhpJsonSerializer;
        $response = new SerializedResponse(['a'], $serializer);

        $expected_header = [['Content-Type: application/json; charset=utf-8']];
        $expected_body = '["a"]';

        $this->assertSame($expected_header, $response->getResponseHeaders($app));
        $this->assertSame($expected_body, $response->render($app));
    }
}
