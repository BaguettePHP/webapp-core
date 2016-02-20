<?php
namespace Baguette;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param  string|array $method
     * @param  mixed        $args...
     * @return callable
     */
    public static function methodAsPublic ($class_method)
    {
        if (is_array($class_method)) {
            list($class, $method) = $class_method;
            $ref = new \ReflectionMethod($class, $method);
        } else {
            $class = null;
            $ref = new \ReflectionMethod($class_method);
        }

        $ref->setAccessible(true);
        $obj = is_object($class) ? $class : null;

        return function () use ($class, $ref, $obj) {
            $args = func_get_args();
            return $ref->invokeArgs($obj, $args);
        };

    }
}
