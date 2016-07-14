<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 15:15
 */

namespace Dizzy\Trakt\Exceptions\HttpCodeException;

/**
 * Class StatusCodeException
 * @package Dizzy\Trakt\Exceptions\HttpCodeException
 */
class StatusCodeException extends \Exception
{
    protected $message = 'An unknown http status error occured: %s';

    /**
     * StatusCodeException constructor.
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(printf($this->message, $code));
    }
}