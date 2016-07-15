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

use Dizzy\Trakt\Request\Movies\Popular as PopularRequest;
use Dizzy\Trakt\Request\Movies\Trending as TrendingRequest;

class Movies extends AbstractEndpoint {
    


    public function popular()
{
    return $this->request(new PopularRequest());
}

	public function trending()
{
    return $this->request(new TrendingRequest());
}

}
