<?php

namespace Baguette\Response;

/**
 * HTML Template Response
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class TwigResponse implements ResponseInterface
{
    const CONTENT_TYPE_HTML  = 'text/html; charset=utf-8';

    /** @var \Twig_Environment */
    protected static $twig;
    /** @var string */
    public $tpl_name;
    /** @var array */
    public $params;
    /** @var string|null */
    public $content_type;
    /** @var int */
    public $status_code;

    /**
     * @param string $tpl_name
     * @param array  $params
     * @param int    $status_code
     */
    public function __construct($tpl_name, array $params = [], $status_code = 200)
    {
        $this->tpl_name = $tpl_name;
        $this->params   = $params;
        $this->status_code = $status_code;
    }

    /**
     * @return array[]
     */
    public function getResponseHeaders()
    {
        return [
            ['Content-Type: '. self::CONTENT_TYPE_HTML],
        ];
    }

    /**
     * @param  \Baguette\Application $app
     * @return string
     */
    public function render(\Baguette\Application $app)
    {
        $params = $this->params + [
            'server' => $app->server,
            'cookie' => $app->cookie,
            'get'    => $app->get,
            'post'   => $app->post,
            'now'    => $app->now,
        ];

        return self::$twig->render($this->tpl_name, $params);
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param  \Twig_Environment
     */
    public static function setTwigEnvironment(\Twig_Environment $twig)
    {
        self::$twig = $twig;
    }
}
