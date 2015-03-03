<?php
namespace Baguette;
use Teto;

/**
 * Base class of web application
 *
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
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
    abstract public function execute(Teto\Routing\Action $action);

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
        if (!headers_sent()) {
            http_response_code($response->getHttpStatusCode($this));

            foreach ($response->getResponseHeaders($this) as $header) {
                $string  = array_shift($header);
                $replace = array_shift($header);
                $http_response_code = array_shift($header);

                if ($replace === null) { $replace = true; }

                if ($http_response_code === null) {
                    header($string, $replace);
                } else {
                    header($string, $replace, $http_response_code);
                }
            }
        }

        return $response->render($this);
    }

}
