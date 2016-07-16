<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 01:48
 */

namespace Dizzy\Trakt\Request\Movies;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;

/**
 * Class Updated
 * @package Dizzy\Trakt\Request\Movies
 */
class Updated extends AbstractRequest
{
    private $date;

    /**
     * Updated constructor.
     * @param $date
     */
    public function __construct($date)
    {
        parent::__construct();
        $this->date = $date;
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
        return "movies/updated/:date";
    }
}