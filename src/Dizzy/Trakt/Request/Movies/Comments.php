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

/**
 * Class Comments
 * @package Dizzy\Trakt\Request\Movies
 */
class Comments extends AbstractRequest
{
    private $id;
    private $sort;

    /**
     * Comments constructor.
     * @param $id
     * @param $sort
     */
    public function __construct($id, $sort = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->sort = $sort;
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