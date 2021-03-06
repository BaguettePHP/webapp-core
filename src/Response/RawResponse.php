<?php

namespace Baguette\Response;

use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\StreamInterface;
use Teto\HTTP;

/**
 * Interface of Response classes
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class RawResponse implements ResponseInterface
{
    /** @var Stream */
    public $content;
    /** @var string */
    public $content_type;
    /** @var int */
    public $status_code;

    /**
     * @param resource|string|null|int|float|bool|StreamInterface|callable $content
     * @param int    $status_code
     * @param string $content_type
     */
    public function __construct($content, $content_type = null, $status_code = 200)
    {
        $this->content = \GuzzleHttp\Psr7\stream_for($content);
        $this->content_type = ($content_type === null)
                            ? HTTP\ContentType::Application_OctetStream
                            : $content_type ;
        $this->status_code = $status_code;
    }

    /**
     * @return array
     */
    public function getResponseHeaders()
    {
        return [
            'content-type' => [$this->content_type],
        ];
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @return Stream
     */
    public function render(\Baguette\Application $_)
    {
        return $this->content;
    }
}
