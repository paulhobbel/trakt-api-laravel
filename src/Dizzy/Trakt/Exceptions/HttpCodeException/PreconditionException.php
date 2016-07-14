<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:30
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class PreconditionException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class PreconditionException extends \Exception
{
    protected $message = "Precondition Failed - use application/json content type.";
}