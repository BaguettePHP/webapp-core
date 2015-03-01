<?php
namespace Baguette\Response;
use Baguette;

/**
 * Interface of Response classes
 *
 * @package   Baguette\Response
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class RawResponse implements ResponseInterface
{
    /** @var string */
    public $content;

    /** @var string */
    public $content_type;

    /**
     * @param string $content
     * @param string $content_type
     */
    public function __construct($content, $content_type = null)
    {
        $this->content = $content;
        $this->content_type = ($content_type === null)
                            ? Baguette\HTTP\ContentType::Application_OctetStream
                            : $content_type ;
    }

    /**
     * @param  \Baguette\Application $_ is not used.
     * @return array[]
     */
    public function getResponseHeaders(Baguette\Application $_)
    {
        return [
            ['Content-Type: ' . $this->content_type],
        ];
    }

    /**
     * @param  \Baguette\Application $_ is not used.
     * @return string
     */
    public function render(Baguette\Application $_)
    {
        return $this->content;
    }
}
