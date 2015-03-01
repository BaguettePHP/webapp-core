<?php
namespace Baguette\Serializer;

/**
 * Interface of Response serializer classes
 *
 * @package   Baguette\Serializer
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
interface SerializerInterface
{
    /** @return string */
    public function getContentType();

    /**
     * @param  mixed  $value
     * @return string
     */
    public function serialize($value);
}
