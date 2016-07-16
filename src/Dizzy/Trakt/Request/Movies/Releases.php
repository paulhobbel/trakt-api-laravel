<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 01:53
 */

namespace Dizzy\Trakt\Request\Movies;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\CountryTrait;
use Dizzy\Trakt\Traits\RequestParameters\IdTrait;

/**
 * Class Releases
 * @package Dizzy\Trakt\Request\Movies
 */
class Releases extends AbstractRequest
{
    use IdTrait, CountryTrait;

    /**
     * Releases constructor.
     * @param $id
     * @param $country
     */
    public function __construct($id, $country = null)
    {
        parent::__construct();
        $this->setId($id);
        $this->setCountry($country);
    }

    /**
     * Tells which request type needs to be used for this request.
     * @return string
     */
    public function getRequestType()
    {
        return RequestType::GET;
    }

    /**
     * Tells the uri of this endpoint.
     * @return string
     */
    public function getUri()
    {
        return "movies/:id/releases/:country";
    }
}