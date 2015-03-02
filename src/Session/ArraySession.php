<?php
namespace Baguette\Session;


final class ArrayManager implements SessionInterface
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
