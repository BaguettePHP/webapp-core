<?php

namespace Baguette\Response;

use Baguette\Application;
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
    /** @var string */
    public $content;
    /** @var string */
    public $content_type;
    /** @var int */
    public $status_code;

    /**
     * @param string $content
     * @param int    $status_code
     * @param string $content_type
     */
    public function __construct($content, $content_type = null, $status_code = 200)
    {
        $this->content = $content;
        $this->content_type = ($content_type === null)
                            ? HTTP\ContentType::Application_OctetStream
                            : $content_type ;
        $this->status_code = $status_code;
    }

    /**
     * @return array[]
     */
    public function getResponseHeaders()
    {
        return [
            ['Content-Type: ' . $this->content_type],
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
     * @return string
     */
    public function render(\Baguette\Application $_)
    {
        return $this->content;
    }
}
