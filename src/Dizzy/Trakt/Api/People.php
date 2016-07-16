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

use Dizzy\Trakt\Request\People\Movies as MoviesRequest;
use Dizzy\Trakt\Request\People\Shows as ShowsRequest;
use Dizzy\Trakt\Request\People\Summary as SummaryRequest;

class People extends AbstractEndpoint {
    


    public function movies($id)
    {
        return $this->request(new MoviesRequest($id));
    }

	public function shows($id)
    {
        return $this->request(new ShowsRequest($id));
    }

	public function summary($id)
    {
        return $this->request(new SummaryRequest($id));
    }

	public function get($id)
    {
        return $this->request(new SummaryRequest($id));
    }

}
