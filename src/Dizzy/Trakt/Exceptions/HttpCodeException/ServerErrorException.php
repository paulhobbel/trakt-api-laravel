<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:32
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class ServerErrorException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class ServerErrorException extends \Exception
{
    protected $message = "Server Error - a server error occurred!";
}