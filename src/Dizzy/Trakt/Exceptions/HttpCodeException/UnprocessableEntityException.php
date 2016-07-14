<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:36
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class UnprocessableEntityException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class UnprocessableEntityException extends \Exception
{
    protected $message = "Unprocessable Entity - validation errors";
}