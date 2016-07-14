<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:19
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class BadRequestException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class BadRequestException extends \Exception
{
    protected $message = "Bad Request - request couldn't be parsed";
}