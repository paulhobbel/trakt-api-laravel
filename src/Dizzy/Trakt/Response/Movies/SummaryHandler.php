<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 17-7-2016
 * Time: 00:34
 */

namespace Dizzy\Trakt\Response\Movies;

use Dizzy\Trakt\Api\Movies;
use Dizzy\Trakt\Media\AbstractMedia;
use Dizzy\Trakt\Media\Movie;
use Dizzy\Trakt\Response\AbstractResponseHandler;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Class SummaryHandler
 * @package Dizzy\Trakt\Response\Movies
 */
class SummaryHandler extends AbstractResponseHandler
{

    /**
     * Handles a request
     * @param ClientInterface $client
     * @param ResponseInterface $response
     * @return Collection|AbstractMedia
     */
    public function handle(ClientInterface $client, ResponseInterface $response)
    {
        $json = $this->getJson($response);

        return new Movie($client, new Movies($client), $json);
    }
}