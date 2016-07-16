<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Dizzy\Trakt\Api;

use Dizzy\Trakt\Request\Genres\Get as GetRequest;

class Genres extends AbstractEndpoint {
    


    public function get($type)
    {
        return $this->request(new GetRequest($type));
    }

}
