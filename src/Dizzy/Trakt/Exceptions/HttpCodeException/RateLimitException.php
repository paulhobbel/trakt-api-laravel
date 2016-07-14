<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:31
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;


class RateLimitException extends \Exception
{
    protected $message = "Rate Limit Exceeded - too many requests have been send in a short time";
}