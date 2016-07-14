<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 13:45
 */

namespace Dizzy\Trakt\Exceptions;


class MalformedParameterException extends \Exception
{
    protected $message = 'Trying to access a getter that does not exists on the request object';
}