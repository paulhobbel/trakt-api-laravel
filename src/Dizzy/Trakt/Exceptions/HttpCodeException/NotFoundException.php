<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:29
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class NotFoundException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class NotFoundException extends \Exception
{
    protected $message = "Not Found - method exists, but no record found";
}