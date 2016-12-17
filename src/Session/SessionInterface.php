<?php

namespace Baguette\Session;

/**
 * Interface of Session classes
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
interface SessionInterface
{
    /**
     * @return boolean
     */
    public function start();

    /**
     * @return string id
     */
    public function id($id = null);

    /**
     * @param  bool $_delete_old_session
     * @return bool
     */
    public function regenerateId($_delete_old_session = false);

    /**
     * @param  string $key
     * @param  array  $options
     * @return mixed  $value
     */
    public function get($key, array $options = []);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * @param string $name
     * @return string
     */
    public function name($name = null);

    /**
     * @return boolean
     */
    public function destroy();
}
