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

use Dizzy\Trakt\Request\Movies\Aliases as AliasesRequest;
use Dizzy\Trakt\Request\Movies\Anticipated as AnticipatedRequest;
use Dizzy\Trakt\Request\Movies\BoxOffice as BoxOfficeRequest;
use Dizzy\Trakt\Request\Movies\Collected as CollectedRequest;
use Dizzy\Trakt\Request\Movies\Comments as CommentsRequest;
use Dizzy\Trakt\Request\Movies\People as PeopleRequest;
use Dizzy\Trakt\Request\Movies\Played as PlayedRequest;
use Dizzy\Trakt\Request\Movies\Popular as PopularRequest;
use Dizzy\Trakt\Request\Movies\Releases as ReleasesRequest;
use Dizzy\Trakt\Request\Movies\Summary as SummaryRequest;
use Dizzy\Trakt\Request\Movies\Translations as TranslationsRequest;
use Dizzy\Trakt\Request\Movies\Trending as TrendingRequest;
use Carbon\Carbon;
use Dizzy\Trakt\Request\Movies\Updated as UpdatedRequest;
use Dizzy\Trakt\Request\Movies\Watched as WatchedRequest;

class Movies extends AbstractEndpoint {
    


    public function aliases($id)
    {
        return $this->request(new AliasesRequest($id));
    }

	public function anticipated()
    {
        return $this->request(new AnticipatedRequest());
    }

	public function boxOffice()
    {
        return $this->request(new BoxOfficeRequest());
    }

	public function collected($period = null)
    {
        return $this->request(new CollectedRequest($period));
    }

	public function comments($id, $sort = null)
    {
        return $this->request(new CommentsRequest($id, $sort));
    }

	public function people($id)
    {
        return $this->request(new PeopleRequest($id));
    }

	public function played($period = null)
    {
        return $this->request(new PlayedRequest($period));
    }

	public function popular()
    {
        return $this->request(new PopularRequest());
    }

	public function releases($id, $country = null)
    {
        return $this->request(new ReleasesRequest($id, $country));
    }

	public function summary($id)
    {
        return $this->request(new SummaryRequest($id));
    }

	public function get($id)
    {
        return $this->request(new SummaryRequest($id));
    }

	public function translations($id, $country = null)
    {
        return $this->request(new TranslationsRequest($id, $country));
    }

	public function trending()
    {
        return $this->request(new TrendingRequest());
    }

	public function updated(Carbon $date = null)
    {
        return $this->request(new UpdatedRequest($date));
    }

	public function watched($period = null)
    {
        return $this->request(new WatchedRequest($period));
    }

}
