<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 22:19
 */

namespace Dizzy\Trakt\Exceptions;


class ClassCanNotBeImplementedAsEndpointException extends \Exception
{
    protected $message = "This class can not be implemented as endpoint!";
}