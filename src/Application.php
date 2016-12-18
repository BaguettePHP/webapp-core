<?php

namespace Baguette;

/**
 * Base class of web application
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 *
 * @property-read array $server $_SERVER
 * @property-read array $cookie $_COOKIE
 * @property-read array $get    $_GET
 * @property-read array $post   $_POST
 * @property-read \DateTimeImmutable $now
 */
abstract class Application
{
    /** @var array $_SERVER */
    protected $server;
    /** @var array $_COOKIE */
    protected $cookie;
    /** @var array $_GET */
    protected $get;
    /** @var array $_POST */
    protected $post;
    /** @var \DateTimeImmutable */
    protected $now;

    /**
     * @param array $server $_SERVER
     * @param array $cookie $_COOKIE
     * @param array $get    $_GET
     * @param array $post   $_POST
     * @param \DateTimeImmutable $now
     */
    public function __construct(array $server, array $cookie, array $get, array $post, \DateTimeImmutable $now = null)
    {
        $this->server = $server;
        $this->cookie = $cookie;
        $this->get    = $get;
        $this->post   = $post;
        $this->now    = $now ?: new \DateTimeImmutable;
    }

    /**
     * @param  \Teto\Routing\Action $action
     * @return \Baguette\Response\ResponseInterface
     */
    abstract public function execute(\Teto\Routing\Action $action);

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param  \Baguette\Response\ResponseInterface $response
     * @return string
     */
    public function renderResponse(Response\ResponseInterface $response)
    {
        if (!static::headers_sent()) {
            static::http_response_code($response->getHttpStatusCode());

            foreach ($response->getResponseHeaders() as $type => $values) {
                foreach ($values as $v) {
                    static::header("{$type}: {$v}");
                }
            }
        }

        return $response->render($this);
    }

    /**
     * @return bool
     */
    protected function headers_sent()
    {
        return \headers_sent();
    }

    /**
     * @param string $string
     * @param bool   $replace
     * @param int    $http_response_code
     */
    protected function header($string)
    {
        \header($string);
    }

    /**
     * @param  int $response_code
     * @return int
     */
    protected function http_response_code($response_code = null)
    {
        if ($response_code === null) {
            return \http_response_code();
        } else {
            return \http_response_code($response_code);
        }
    }
}
