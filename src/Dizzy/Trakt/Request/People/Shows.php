<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 23:15
 */

namespace Dizzy\Trakt\Request\People;


use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\IdTrait;

class Shows extends AbstractRequest
{
    use IdTrait;

    public function __construct($id)
    {
        parent::__construct();
        $this->setId($id);
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
        return "people/:id/shows";
    }
}