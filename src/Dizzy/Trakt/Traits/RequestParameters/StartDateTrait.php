<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:51
 */

namespace Dizzy\Trakt\Traits\RequestParameters;
use Carbon\Carbon;

/**
 * Class StartDateTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait StartDateTrait
{
    /**
     * @var Carbon;
     */
    private $startDate;

    /**
     * Sets the start date. Defaults to today.
     * @param Carbon|null $startDate
     */
    public function setStartDate(Carbon $startDate = null)
    {
        if(!$startDate) {
            $startDate = Carbon::today();
        }

        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate->format('Y-m-d');
    }
}