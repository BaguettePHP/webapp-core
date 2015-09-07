<?php
namespace Baguette;
use Teto;

/**
 * @codeCoverageIgnore
 *
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class DummyApplication extends Application
{
    public function execute(Teto\Routing\Action $action)
    {
    }
}
