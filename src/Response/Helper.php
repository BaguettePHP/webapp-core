<?php

namespace Baguette\Response;

use Baguette\Application;
use GuzzleHttp\Psr7;
use Psr\Http\Message\MessageInterface;

/**
 * Baguette HTTP Response Helper
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Helper
{
    /**
     * @param  Application       $app
     * @param  ResponseInterface $bag_response
     * @param  MessageInterface  $message
     * @return MessageInterface
     */
    public static function toPsr7(Application $app, ResponseInterface $bag_response, MessageInterface $message = null)
    {
        if ($message === null) {
            $message = new \GuzzleHttp\Psr7\Response();
        }

        $message = $message->withStatus($bag_response->getHttpStatusCode());

        foreach ($bag_response->getResponseHeaders() as $key => $value) {
            $message = $message->withHeader($key, $value);
        }

        $body = $bag_response->render($app);
        return ($body === false) ? $message : $message->withBody(Psr7\stream_for($body));
    }
}
