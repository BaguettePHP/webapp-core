<?php

namespace Baguette\Serializer;

/**
 * JSON Serializer based on PHP JSON module
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/book.json.php
 */
final class PhpJsonSerializer implements SerializerInterface
{
    const CONTENT_TYPE = 'application/json; charset=utf-8';

    private static $JSON_ERROR_CODES = [
        JSON_ERROR_DEPTH            => 'JSON_ERROR_DEPTH',
        JSON_ERROR_STATE_MISMATCH   => 'JSON_ERROR_STATE_MISMATCH',
        JSON_ERROR_CTRL_CHAR        => 'JSON_ERROR_CTRL_CHAR',
        JSON_ERROR_SYNTAX           => 'JSON_ERROR_SYNTAX',
        JSON_ERROR_UTF8             => 'JSON_ERROR_UTF8',
        JSON_ERROR_RECURSION        => 'JSON_ERROR_RECURSION',
        JSON_ERROR_INF_OR_NAN       => 'JSON_ERROR_INF_OR_NAN',
        JSON_ERROR_UNSUPPORTED_TYPE => 'JSON_ERROR_UNSUPPORTED_TYPE',
    ];

    /** @var int */
    public $json_encode_option;

    /** @var boolean */
    public $empty_as_object;

    /**
     * @param int $json_encode_option
     * @link  http://php.net/manual/json.constants.php
     */
    public function __construct($json_encode_option = null)
    {
        $this->json_encode_option
            = ($json_encode_option !== null) ? $json_encode_option
            : JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    }

    /**
     * @param  boolean $value
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
     * @throws \DomainException
     * @link   http://php.net/manual/function.json-encode.php
     * @link   http://php.net/manual/function.json-last-error.php
     */
    public function serialize($value)
    {
        if ($this->empty_as_object && $value === []) {
            $json = json_encode([], $this->json_encode_option | JSON_FORCE_OBJECT);
        } else {
            $json = json_encode($value, $this->json_encode_option);
        }

        if ($json !== false) { return $json; }

        $error_code = json_last_error();

        if ($error_code === JSON_ERROR_NONE) { return false; }

        $message = isset(self::$JSON_ERROR_CODES[$error_code])
                 ? self::$JSON_ERROR_CODES[$error_code]
                 : 'Unknown JSON Error' ;

        throw new \DomainException($message);
    }
}
