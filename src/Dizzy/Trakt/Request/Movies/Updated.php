<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 01:48
 */

namespace Dizzy\Trakt\Request\Movies;


use Carbon\Carbon;
use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\StartDateTrait;

/**
 * Class Updated
 * @package Dizzy\Trakt\Request\Movies
 */
class Updated extends AbstractRequest
{
    use StartDateTrait;

    /**
     * Updated constructor.
     * @param $date
     */
    public function __construct(Carbon $date = null)
    {
        parent::__construct();
        $this->setStartDate($date);
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
        return "movies/updated/:start_date";
    }
}