<?php

namespace Baguette;

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
            ['Content-Type: text/html; charset=UTF-8', true, null],
        ];

        $app = new \Baguette\DummyApplication([], [], [], []);
        $raw = new \Baguette\Response\RawResponse($body, $content_type);

        $actual = $app->renderResponse($raw);
        $this->assertSame($body, $actual);
        $this->assertSame($expected_status, $app->sent_status);

        foreach ($expected_headers as $h) {
            $this->assertContains($h, $app->sent_headers);
        }
    }
}
