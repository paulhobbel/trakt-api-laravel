<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 01:32
 */

namespace Dizzy\Trakt\Request\Movies;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\PeriodTrait;

/**
 * Class Collected
 * @package Dizzy\Trakt\Request\Movies
 */
class Collected extends AbstractRequest
{
    use PeriodTrait;

    /**
     * Collected constructor.
     * @param null $period
     */
    public function __construct($period = null)
    {
        parent::__construct();
        $this->setPeriod($period);
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
        return "movies/collected/:period";
    }
}