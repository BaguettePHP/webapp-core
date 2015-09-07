<?php
namespace Baguette;
use Baguette\DummyApplication;
use Baguette\Response\RawResponse;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
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
        $content_type = 'text/html';
        $expected_headers = [
            'Content-type: text/html; charset=UTF-8'
        ];

        $app = new DummyApplication([], [], [], []);
        $raw = new RawResponse($body, $content_type);

        $actual_headers = xdebug_get_headers();

        $this->assertSame($body, $app->renderResponse($raw));
        foreach ($expected_headers as $h) {
            $this->assertContains($h, $actual_headers);
        }
    }
}
