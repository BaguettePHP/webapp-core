<?php
namespace Baguette\HTTP;

/**
 * HTTP ContentType repository
 *
 * @package   Baguette\HTTP
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://www.iana.org/assignments/media-types/media-types.xhtml
 */
final class ContentType
{
    const Application_Atom = 'application/atom+xml';
    const Application_EPUB = 'application/epub+zip';
    const Application_Flash = 'application/x-shockwave-flash';
    const Application_Gzip = 'application/gzip';
    const Application_JSON = 'application/json';
    const Application_JSON_LD = 'application/ld+json';
    const Application_JavaScript = 'application/javascript';
    const Application_OctetStream = 'application/octet-stream';
    const Application_PDF = 'application/pdf';
    const Application_RDF = 'application/rdf+xml';
    const Application_RSS = 'application/rss+xml';
    const Application_WOFF = 'application/font-woff';
    const Application_XHTML = 'application/xhtml+xml';
    const Application_XML = 'application/xml';
    const Application_Zip = 'application/zip';
    const Audio_Basic = 'audio/basic';
    const Audio_MID = 'audio/mid';
    const Audio_MP3 = 'audio/mpeg';
    const Audio_MPEG = 'audio/mpeg';
    const Audio_OggVorbis = 'audio/vorbis';
    const Audio_WAV = 'audio/vnd.wave';
    const Image_APNG = 'image/vnd.mozilla.apng';
    const Image_Bitmap = 'image/x-ms-bmp';
    const Image_GIF = 'image/gif';
    const Image_ICO = 'image/vnd.microsoft.icon';
    const Image_JPEG = 'image/jpeg';
    const Image_PNG = 'image/png';
    const Image_SVG = 'image/svg+xml';
    const Image_TIF = 'image/tiff';
    const Image_Ugoira = 'image/vnd.pixiv.ugoira+zip';
    const Text_CSS = 'text/css';
    const Text_CSV = 'text/csv';
    const Text_HTML = 'text/html';
    const Text_Markdown = 'text/markdown'; // TEMPORARY - expires 2015-11-11
    const Text_Plain = 'text/plain';
    const Text_SGML = 'text/SGML';
    const Text_vCard = 'text/directory; profile="vcard"';
    const Video_H264 = 'video/H264';
    const Video_MPEG = 'video/mpeg';
    const Video_QuickTime = 'video/quicktime';

    private function __construct() {}
}
