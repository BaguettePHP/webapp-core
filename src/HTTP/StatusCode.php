<?php
namespace Baguette\HTTP;

/**
 * HTTP StatusCode repository
 *
 * @package   Baguette\HTTP
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class StatusCode
{
    const OK                    = 200;
    const Created               = 201;
    const Accepted              = 202;
    const No_Content            = 204;
    const Reset_Content         = 205;
    const Moved_Permanently     = 301;
    const Found                 = 302;
    const See_Other             = 303;
    const Not_Modified          = 304;
    const Temporary_Redirect    = 307;
    const Permanent_Redirect    = 308;
    const Bad_Request           = 400;
    const Unauthorized          = 401;
    const Payment_Required      = 402;
    const Forbidden             = 403;
    const Not_Found             = 404;
    const Method_Not_Allowed    = 405;
    const Not_Acceptable        = 406;
    const Im_a_teapot           = 418;
    const Internal_Server_Error = 500;
    const Service_Unavailable   = 503;

    private function __construct() {}
}
