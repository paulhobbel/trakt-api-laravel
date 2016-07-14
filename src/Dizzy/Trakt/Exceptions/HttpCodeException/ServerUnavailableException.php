<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:34
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class ServerUnavailableException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class ServerUnavailableException extends \Exception
{
    protected $message = "Service Unavailable - server overloaded!";
}