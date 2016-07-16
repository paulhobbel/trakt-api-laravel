<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:48
 */

namespace Dizzy\Trakt\Traits\RequestParameters;

/**
 * Class CountryTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait CountryTrait
{
    private $country;

    /**
     * Validate and set the country.
     * @param $country
     * @todo Validate the value
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
}