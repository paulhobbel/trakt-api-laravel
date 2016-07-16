<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 23:09
 */

namespace Dizzy\Trakt\Contracts;


/**
 * Interface RequestInterface
 * @package Dizzy\Trakt\Contracts
 */
interface RequestInterface
{
    /**
     * Tells which request type needs to be used for this request.
     * @return string
     */
    public function getRequestType();

    /**
     * Tells the uri of this endpoint.
     * @return string
     */
    public function getUri();

}