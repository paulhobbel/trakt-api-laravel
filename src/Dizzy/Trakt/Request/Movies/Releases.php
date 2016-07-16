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

/**
 * Class Releases
 * @package Dizzy\Trakt\Request\Movies
 */
class Releases extends AbstractRequest
{
    private $id;
    private $country;

    /**
     * Releases constructor.
     * @param $id
     * @param $country
     */
    public function __construct($id, $country = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->country = $country;
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