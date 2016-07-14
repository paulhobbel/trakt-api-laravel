<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:35
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class UnauthorizedException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class UnauthorizedException extends \Exception
{
    protected $message = "Unauthorized - OAuth must be provided, (Not Supported Yet!)";
}