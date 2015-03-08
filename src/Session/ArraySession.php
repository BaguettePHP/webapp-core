<?php
namespace Baguette\Session;

/**
 * Session class based on Array
 *
 * @package   Baguette\Session
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/book.session.php
 */
class ArraySession implements SessionInterface
{
    private $session;

    public function __construct() {}

    /**
     * @return boolean
     */
    public function start()
    {
        $this->session = [];

        return true;
    }

    /**
     * @param  string $name
     * @param  array  $options
     * @return mixed  $value
     */
    public function get($name, array $options = [])
    {
        if (array_key_exists($name, $this->session)) { return $this->session[$name]; }
        if (array_key_exists('default', $options)) { return $options['default']; }

        throw new \OutOfRangeException($name);
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value)
    {
        $this->session[$name] = $value;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->session;
    }

    /**
     * @return boolean
     */
    public function destroy()
    {
        $this->session = null;

        return true;
    }
}
