<?php

namespace Baguette\Response;

/**
 * Interface of Response classes
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
interface ResponseInterface
{
    /** @return array */
    public function getResponseHeaders();

    /** @return int */
    public function getHttpStatusCode();

    /** @return string|null */
    public function render(\Baguette\Application $app);
}
