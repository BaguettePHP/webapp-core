<?php
namespace Baguette\Session;

/**
 * Interface of Session classes
 *
 * @package   Baguette\Session
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
interface SessionInterface
{
    /**
     * @return boolean
     */
    public function start();

    /**
     * @param  string $name
     * @param  array  $options
     * @return mixed  $value
     */
    public function get($name, array $options = []);

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value);

    /**
     * @return boolean
     */
    public function destroy();
}
