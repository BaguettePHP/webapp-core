<?php

namespace Baguette;

use Psr\Http\Message\StreamInterface;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class ApplicationTest extends \Baguette\TestCase
{
    /**
     * @runTestsInSeparateProcesses
     */
    public function test()
    {
        $body = "A\nB\nC";
        $content_type = 'text/html; charset=UTF-8';
        $expected_status = 200;
        $expected_headers = [
            'content-type' => ['text/html; charset=UTF-8'],
        ];

        $app = new \Baguette\DummyApplication([], [], [], []);
        $raw = new \Baguette\Response\RawResponse($body, $content_type);

        $actual = $app->renderResponse($raw);
        $this->assertInstanceof(StreamInterface::class, $actual);
        $this->assertSame($body, (string)$actual);
        $this->assertSame($expected_status, $app->sent_status);

        foreach ($expected_headers as $type => $headers) {
            foreach ($headers as $h) {
                $this->assertContains("{$type}: {$h}", $app->sent_headers);
            }
        }
    }
}
