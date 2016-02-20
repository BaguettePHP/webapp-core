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
    /** @var array */
    private $session;
    /** @var string */
    private $id = '';
    /** @var string */
    private $name;

    const SESSID_CHARS = '-ABCDEFGHIJKLMNOPQRSQUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    public function __construct(array $options = []) {
        $this->name = isset($options['name']) ? $options['name'] : session_name();
    }

    /**
     * @param  array   $options
     * @return boolean
     */
    public function start()
    {
        $this->session = [];
        $this->id = self::genid();

        return true;
    }

    /**
     * @return string id
     */
    public function id($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }

        return $this->id;
    }

    /**
     * @param  bool $_delete_old_session
     * @return bool
     */
    public function regenerateId($_delete_old_session = false)
    {
        $this->id = self::genid();

        return true;
    }

    /**
     * @param  string $key
     * @param  array  $options
     * @return mixed  $value
     */
    public function get($key, array $options = [])
    {
        if (array_key_exists($key, $this->session)) { return $this->session[$key]; }
        if (array_key_exists('default', $options)) { return $options['default']; }

        throw new \OutOfRangeException($key);
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->session[$key] = $value;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->session;
    }

    /**
     * @param  string $name
     * @return string
     */
    public function name($name = null)
    {
        if ($name !== null) {
            return $this->name;
        }

        $old = $this->name;
        $this->name = $name;

        return $old;
    }

    /**
     * @return boolean
     */
    public function destroy()
    {
        $this->session = [];

        return true;
    }

    /**
     * @return string
     */
    private function genid()
    {
        return (new \RandomLib\Factory)
            ->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM))
            ->generateString(26, self::SESSID_CHARS);
    }
}
