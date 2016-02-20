<?php
namespace Baguette\Session;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class ArraySessionTest extends \Baguette\TestCase
{
    const RE_SESSION_ID = '/^[-ABCDEFGHIJKLMNOPQRSQUVWXYZabcdefghijklmnopqrstuvwxyz0123456789]{26}$/';

    public function test_genid()
    {
        $method = $this->methodAsPublic([new ArraySession, 'genid']);

        $this->assertRegExp(self::RE_SESSION_ID, $method());
    }
}
