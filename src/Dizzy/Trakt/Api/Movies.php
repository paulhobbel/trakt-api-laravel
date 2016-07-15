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

use Dizzy\Trakt\Request\Movies\Get as GetRequest;
use Dizzy\Trakt\Request\Movies\Popular as PopularRequest;
use Dizzy\Trakt\Request\Movies\Trending as TrendingRequest;

class Movies extends AbstractEndpoint {
    


    public function get($id)
{
    return $this->request(new GetRequest($id));
}

	public function popular()
{
    return $this->request(new PopularRequest());
}

	public function trending()
{
    return $this->request(new TrendingRequest());
}

}
