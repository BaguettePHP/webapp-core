<?php

namespace Baguette\Response;

use Baguette;

/**
 * Serialized data Response class
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class SerializedResponse implements ResponseInterface
{
    /** @var array */
    public $value;
    /** @var \Baguette\Serializer\SerializerInterface */
    public $serializer;
    /** @var int */
    private $status_code;

    /**
     * @param array $value
     * @param \Baguette\Serializer\SerializerInterface $serializer
     * @param int   $status_code
     */
    public function __construct(array $value, Baguette\Serializer\SerializerInterface $serializer, $status_code = 200)
    {
        $this->value = $value;
        $this->serializer = $serializer;
        $this->status_code = $status_code;
    }

    /**
     * @return array[]
     */
    public function getResponseHeaders()
    {
        return [
            ['Content-Type: '. $this->serializer->getContentType()]
        ];
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @return string
     */
    public function render(Baguette\Application $_)
    {
        return $this->serializer->serialize($this->value);
    }
}
