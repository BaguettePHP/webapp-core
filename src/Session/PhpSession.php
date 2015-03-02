<?php
namespace Baguette\Session;

/**
 * Session class based on PHP
 *
 * @package   Baguette\Response
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/book.session.php
 */
final class PhpSessionManager implements SessionInterface
{
    public function __construct() {}

    /**
     * @return boolean
     */
    public function start()
    {
        return session_start();
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
     * @return boolean
     */
    public function destroy()
    {
        $_SESSION = [];

        return session_destroy();
    }
}
