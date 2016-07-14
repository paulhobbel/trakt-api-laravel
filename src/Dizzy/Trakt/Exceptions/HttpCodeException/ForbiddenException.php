<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:25
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class ForbiddenException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class ForbiddenException extends \Exception
{
    protected $message = "Forbidden - invalid API key or a unapproved app.";
}