<?php

namespace Baguette\Response;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class TwigResponseTest extends \Baguette\TestCase
{
    public function test()
    {
        $now = \DateTimeImmutable::createFromFormat('Y-m-d', '1999-07-01');
        $app = new \Baguette\DummyApplication(['a' => 'A'], ['b' => 'B'], ['c' => 'C'], ['d' => 'D'], $now);
        $loader = new \Twig_Loader_Array([
            'tmpl' => '{{ server.a }}, {{ cookie.b }}, {{ get.c }}, {{ post.d }}, {{ now.format("Y-m-d") }}!',
        ]);
        TwigResponse::setTwigEnvironment(new \Twig_Environment($loader));

        $twig_response = new TwigResponse('tmpl', ['foo' => 'bar']);

        $expected_header = [['Content-Type: text/html; charset=utf-8']];
        $expected_body = 'A, B, C, D, 1999-07-01!';

        $this->assertSame($expected_header, $twig_response->getResponseHeaders($app));
        $this->assertSame($expected_body, $twig_response->render($app));
    }
}
