<?php
namespace Baguette\Application;

/**
 * PHP errors trait for Application
 *
 * @package   Baguette\Application
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      https://github.com/filp/whoops
 */
trait Whoopsable
{
    /** @var \Whoops\Run */
    private $whoops;

    public function setWhoops(\Whoops\Run $whoops)
    {
        $this->whoops = $whoops;
    }
}
