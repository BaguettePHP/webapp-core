<?php

namespace Baguette\Session;

/**
 * Session class based on PHP
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/book.session.php
 */
class PhpSession implements SessionInterface
{
    public function __construct(array $options = [])
    {
        if (isset($options['name'])) {
            session_name($options['name']);
        }
    }

    /**
     * @param  array   $options
     * @return boolean
     */
    public function start()
    {
        return session_start();
    }

    /**
     * @return string id
     * @link   http://php.net/manual/function.session-id.php
     */
    public function id($id = null)
    {
        if ($id === null) {
            return session_id();
        }

        return session_id($id);
    }

    /**
     * @param  bool $delete_old_session
     * @return bool
     * @link   http://php.net/manual/function.session-regenerate-id.php
     */
    public function regenerateId($delete_old_session = false)
    {
        return session_regenerate_id($delete_old_session);
    }

    /**
     * @param  string $name
     * @param  array  $options
     * @return mixed  $value
     */
    public function get($name, array $options = [])
    {
        if (array_key_exists($name, $_SESSION)) { return $_SESSION[$name]; }
        if (array_key_exists('default', $options)) { return $options['default']; }

        throw new \OutOfRangeException($name);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $_SESSION;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @param string $name
     * @return string
     */
    public function name($name = null)
    {
        if ($name !== null) {
            return session_name($name);
        }

        return session_name();
    }

    /**
     * @return boolean
     */
    public function destroy()
    {
        $_SESSION = [];

        return session_destroy();
    }
}
