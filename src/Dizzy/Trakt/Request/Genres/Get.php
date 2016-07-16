<?php
/**
 * Created by PhpStorm.
 * User: paulh
 * Date: 16-7-2016
 * Time: 01:40
 */

namespace Dizzy\Trakt\Request\Genres;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;

class Get extends AbstractRequest
{
    private $type;

    /**
     * Get constructor.
     * @param $type
     */
    public function __construct($type)
    {
        parent::__construct();
        $this->type = $type;
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