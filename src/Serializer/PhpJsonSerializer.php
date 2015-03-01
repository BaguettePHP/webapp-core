<?php
namespace Baguette\Serializer;

/**
 * JSON Serializer based on PHP JSON module
 *
 * @package   Baguette\Serializer
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class PhpJsonSerializer implements SerializerInterface
{
    const CONTENT_TYPE = 'application/json; charset=utf-8';

    /** @var int */
    public $json_encode_option;

    /** @var boolean */
    public $empty_as_object;

    /**
     * @param int $json_encode_option
     */
    public function __construct($json_encode_option = null)
    {
        $this->json_encode_option
            = ($json_encode_option !== null) ? $json_encode_option
            : JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            ;
    }

    /**
     * @param  boolean      $value
     * @return JsonResponse $this
     */
    public function setEmptyAsObject($value = true)
    {
        $this->empty_as_object = $value;

        return $this;
    }

    /** @return string */
    public function getContentType()
    {
        return self::CONTENT_TYPE;
    }

    /**
     * @param  mixed  $value
     * @return string
     */
    public function serialize($value)
    {
        if ($this->empty_as_object && $value === []) {
            return json_encode([], $this->json_encode_option | JSON_FORCE_OBJECT);
        }

        return json_encode($value, $this->json_encode_option);
    }
}
