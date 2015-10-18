<?php
namespace Baguette;
use Teto;

/**
 * @codeCoverageIgnore
 *
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class DummyApplication extends Application
{
    /** @var string[] */
    protected $sent_headers = [];

    public function execute(Teto\Routing\Action $action)
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
     * @param bool   $replace
     * @param int    $http_response_code
     */
    protected function header($string, $replace, $http_response_code)
    {
        $this->sent_headers[] = [$string, $replace, $http_response_code];
    }
}
