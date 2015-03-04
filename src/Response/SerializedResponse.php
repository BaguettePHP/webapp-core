<?php
namespace Baguette\Response;
use Baguette;

/**
 * Serialized data Response class
 *
 * @package   Baguette\Response
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
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
     * @param  \Baguette\Application $_ is not used.
     * @return array[]
     */
    public function getResponseHeaders(Baguette\Application $_)
    {
        return [
            ['Content-Type: '. $this->serializer->getContentType()]
        ];
    }

    /**
     * @param  \Baguette\Application $_ is not used.
     * @return int
     */
    public function getHttpStatusCode(Baguette\Application $_)
    {
        return $this->status_code;
    }

    /**
     * @param  \Baguette\Application $_ is not used.
     * @return string
     */
    public function render(Baguette\Application $_)
    {
        return $this->serializer->serialize($this->value);
    }
}
