<?php

namespace Baguette\Application;

/**
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class ParamTestApplication extends \Baguette\Application
{
    use \Baguette\Application\Param;

    public function execute(\Teto\Routing\Action $action) {}
}

final class ParamTest extends \Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_getParam
     */
    public function test_getParam($expected, $name, $filter, $option, $method)
    {
        $server = ['REQUEST_METHOD' => $method];
        $cookie = ['cFloat' => '98.765'];
        $get    = ['gInt'   => '123456', 'gFloat'   => '123.45', 'gIntArray' => [1, 2, 3]];
        $post   = ['pStr'   => 'string', 'pAccounts' => ['@abc', 'def', '@ghi']];

        $app = new ParamTestApplication($server, $cookie, $get, $post);

        $this->assertSame($expected, $app->getParam($name, $filter, $option));
    }

    public function dataProviderFor_getParam()
    {
        return [
         // $expected   $name         $filter                $option                   $method
            [123456,    'gInt',       FILTER_VALIDATE_INT,   ['default' => -1],        'GET'],
            [123.45,    'gFloat',     FILTER_VALIDATE_FLOAT, ['default' => -1],        'POST'],
            [123456.0,  'gInt',       FILTER_VALIDATE_FLOAT, ['default' => -1],        'GET'],
            [-1,        'gFloat',     FILTER_VALIDATE_INT,   ['default' => -1],        'POST'],
            [-1,        'gIntArray',  FILTER_VALIDATE_INT,   ['default' => -1],        'POST'],
            ['default', 'sStr',       FILTER_VALIDATE_INT,   ['default' => 'default'], 'POST'],
        ];
    }

    /**
     * @dataProvider dataProviderFor_getParamAsArray
     */
    public function test_getParamAsArray($expected, $name, $filter, $option, $method)
    {
        $server = ['REQUEST_METHOD' => $method];
        $cookie = ['cFloat' => '98.765'];
        $get    = ['gInt'   => '123456', 'gFloat'   => '123.45', 'gIntArray' => [1, 2, 3]];
        $post   = ['pStr'   => 'string', 'pAccounts' => ['@abc', 'def', '@ghi']];

        $app = new ParamTestApplication($server, $cookie, $get, $post);

        $this->assertSame($expected, $app->getParamAsArray($name, $filter, $option));
    }

    public function dataProviderFor_getParamAsArray()
    {
        $re = '/^@[a-z]{3}$/';
        $accounts = ['@abc', false, '@ghi'];

        return [
         // $expected   $name         $filter                 $option               $method
            [[1, 2, 3], 'gIntArray',  FILTER_VALIDATE_INT,    ['default' => [-1]],  'POST' ],
            [[-1],      'gIntArray2', FILTER_VALIDATE_INT,    ['default' => [-1]],  'POST' ],
            [[-1],      'gIntArray2', FILTER_VALIDATE_INT,    ['default' => [-1]],  'GET'  ],
            [$accounts, 'pAccounts',  FILTER_VALIDATE_REGEXP, ['regexp' => $re],    'POST' ],
        ];
    }
}
