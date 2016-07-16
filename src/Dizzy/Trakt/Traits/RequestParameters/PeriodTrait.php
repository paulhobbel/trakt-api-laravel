<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:45
 */

namespace Dizzy\Trakt\Traits\RequestParameters;
use Dizzy\Trakt\Exceptions\WrongParameterValueException;

/**
 * Class PeriodTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait PeriodTrait
{
    private $period;

    /**
     * Validate and set the period. Can be set to weekly, monthly or all.
     * @param null $period
     * @throws WrongParameterValueException
     */
    public function setPeriod($period = null)
    {
        if($period) {
            $acceptedValues = ['weekly', 'monthly', 'all'];
            if (in_array($period, $acceptedValues, true)) {
                $this->period = $period;
            } else {
                throw new WrongParameterValueException($acceptedValues);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }
}