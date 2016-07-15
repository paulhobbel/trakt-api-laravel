<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 23:13
 */

namespace Dizzy\Trakt\Request\People;


use Dizzy\Trakt\Contracts\AbstractRequestInterface;
use Dizzy\Trakt\Request\AbstractRequest;
use Dizzy\Trakt\Request\RequestType;

class Movies extends AbstractRequest implements AbstractRequestInterface
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
        return "people/:id/movies";
    }
}