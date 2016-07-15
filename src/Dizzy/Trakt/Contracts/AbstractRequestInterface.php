<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 23:09
 */

namespace Dizzy\Trakt\Contracts;


use Dizzy\Trakt\Request\RequestType;

interface AbstractRequestInterface
{
    /**
     * Tells which request type needs to be used for this request.
     * @return RequestType
     */
    public function getRequestType();

    /**
     * Tells the uri of this endpoint.
     * @return string
     */
    public function getUri();

}