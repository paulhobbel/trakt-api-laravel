<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 00:58
 */

namespace Dizzy\Trakt\Api;

use Dizzy\Trakt\Request\Movies\Popular as PopularRequest;
use Dizzy\Trakt\Request\Movies\Trending as TrendingRequest;

/**
 * Class Movies
 * @package Dizzy\Trakt\Api
 */
class Movies extends AbstractEndpoint
{
    public function popular()
    {
        return $this->request(new PopularRequest());
    }

    public function trending()
    {
        return $this->request(new TrendingRequest());
    }
}