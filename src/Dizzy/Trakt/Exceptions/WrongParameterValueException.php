<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 21:26
 */

namespace Dizzy\Trakt\Exceptions;

/**
 * Class WrongParameterValueException
 * @package Dizzy\Trakt\Exceptions
 */
class WrongParameterValueException extends \Exception
{
    protected $message = 'The given value cannot be accepted for this parameter! Accepted values are %s';

    /**
     * WrongParameterValueException constructor.
     * @param array $acceptedValues
     */
    public function __construct(array $acceptedValues)
    {
        parent::__construct(sprintf($this->message, implode(", ", $acceptedValues)));
    }
}