<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 01:40
 */

namespace Dizzy\Trakt\Request\Genres;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\TypeTrait;

/**
 * Class Get
 * @package Dizzy\Trakt\Request\Genres
 */
class Get extends AbstractRequest
{
    use TypeTrait;

    /**
     * Get constructor.
     * @param $type
     */
    public function __construct($type)
    {
        parent::__construct();
        $this->setType($type);
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
        return "genres/:type";
    }
}