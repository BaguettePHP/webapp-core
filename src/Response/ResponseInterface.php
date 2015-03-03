<?php
namespace Baguette\Response;

/**
 * Interface of Response classes
 *
 * @package   Baguette\Response
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
interface ResponseInterface
{
    /** @return array[] */
    public function getResponseHeaders(\Baguette\Application $app);

    /** @return int */
    public function getHttpStatusCode(\Baguette\Application $app);

    /** @return string */
    public function render(\Baguette\Application $app);
}
