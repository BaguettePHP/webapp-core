<?php

namespace Baguette;

/**
 * @codeCoverageIgnore
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class DummyApplication extends Application
{
    /** @var string[] */
    protected $sent_headers = [];
    /** @var int */
    protected $sent_status;

    public function execute(\Teto\Routing\Action $action)
    {
    }

    /**
     * @return bool
     */
    protected function headers_sent()
    {
        return !empty($this->sent_headers);
    }

    /**
     * @param string $string
     */
    protected function header($string)
    {
        $this->sent_headers[] = $string;
    }

    /**
     * @param  int $response_code
     * @return int
     */
    protected function http_response_code($response_code = null)
    {
        if ($response_code === null) {
            $response_code = $this->sent_status;
        } else {
            $this->sent_status = $response_code;
        }

        return $response_code;
    }
}
