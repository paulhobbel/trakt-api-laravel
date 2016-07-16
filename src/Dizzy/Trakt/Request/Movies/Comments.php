<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 02:07
 */

namespace Dizzy\Trakt\Request\Movies;

use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;
use Dizzy\Trakt\Traits\RequestParameters\IdTrait;
use Dizzy\Trakt\Traits\RequestParameters\SortTrait;

/**
 * Class Comments
 * @package Dizzy\Trakt\Request\Movies
 */
class Comments extends AbstractRequest
{
    use IdTrait, SortTrait;

    /**
     * Comments constructor.
     * @param $id
     * @param $sort
     */
    public function __construct($id, $sort = null)
    {
        parent::__construct();
        $this->setId($id);
        $this->setSort($sort);
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
        return "movies/:id/comments/:sort";
    }
}