<?php

namespace Baguette\Serializer;

/**
 * Interface of Response serializer classes
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
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
