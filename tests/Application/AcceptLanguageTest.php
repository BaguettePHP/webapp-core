<?php
namespace Baguette\Application;
use Baguette;
use Teto;

/**
 * @package   Baguette
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class AcceptLanguageTestApplication extends Baguette\Application
{
    use Baguette\Application\AcceptLanguage;

    public function execute(Teto\Routing\Action $action) {}
}

final class AcceptLanguageTest extends Baguette\TestCase
{
    /**
     * @dataProvider dataProviderFor_getParam
     */
    public function test_getParam($expected, $available_languages, $accept_language)
    {
        $server = ['HTTP_ACCEPT_LANGUAGE' => $accept_language];
        $app = new AcceptLanguageTestApplication($server, [], [], []);

        $this->assertSame($expected, $app->getLanguage($available_languages));
    }

    public function dataProviderFor_getParam()
    {
        return [
         // $expected $available_languages $accept_language
            ['ja',    ['ja', 'en'],        'ja' ],
            ['en',    ['en'],              'ja' ],
            ['ja',    ['ja', 'en'],        'en;q=0.9,ja-JP' ],
        ];
    }
}
