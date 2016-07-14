<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:26
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class MethodNotFoundException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class MethodNotFoundException extends \Exception
{
    protected $message = "Method Not Found - method doesn't exist.";
}