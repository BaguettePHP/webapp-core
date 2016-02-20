<?php
namespace Baguette\Session;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class SessionTest extends \Baguette\TestCase
{
    const RE_SESSION_ID = '/^[-ABCDEFGHIJKLMNOPQRSQUVWXYZabcdefghijklmnopqrstuvwxyz0123456789]{26}$/';

    /**
     * @dataProvider dataProviderFor_test
     * @runInSeparateProcess
     */
    public function test($session_class)
    {
        $actual = new $session_class(['name' => 'testSession']);

        $this->assertEquals('testSession', $actual->name());
        $this->assertSame('', $actual->id());

        $actual->start();

        $this->assertRegExp(self::RE_SESSION_ID, $actual->id());

        $this->assertNull($actual->set('pi', 3.14));
        $this->assertEquals(3.14, $actual->get('pi'));
        $this->assertNull($actual->set('foo', null));
        $this->assertEquals(null, $actual->get('foo'));

        $this->assertEquals(['pi' => 3.14, 'foo' => null], $actual->getAll());

        $old_id = $actual->id();

        $this->assertTrue($actual->regenerateId());
        $this->assertRegExp(self::RE_SESSION_ID, $actual->id());
        $this->assertNotEquals($old_id, $actual->id());

        $this->assertTrue($actual->destroy());
        $this->assertEquals([], $actual->getAll());
    }

    public function dataProviderFor_test()
    {
        return [
            [PhpSession::class],
            [ArraySession::class],
        ];
    }
}
