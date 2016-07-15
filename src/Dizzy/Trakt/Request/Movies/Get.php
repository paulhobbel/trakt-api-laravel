<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 23:05
 */

namespace Dizzy\Trakt\Request\Movies;


use Dizzy\Trakt\Contracts\AbstractRequestInterface;
use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;

class Get extends AbstractRequest implements AbstractRequestInterface
{
    private $id;

    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "movies/:id";
    }
}