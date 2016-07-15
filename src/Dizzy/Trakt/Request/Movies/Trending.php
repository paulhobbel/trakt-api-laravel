<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 00:49
 */

namespace Dizzy\Trakt\Request\Movies;


use Dizzy\Trakt\Contracts\AbstractRequestInterface;
use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;

/**
 * Class Trending
 * @package Dizzy\Trakt\Request\Movies
 */
class Trending extends AbstractRequest implements AbstractRequestInterface
{
    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "movies/trending";
    }
}