<?php
/**
 * Created by PhpStorm.
 * User: paulh
 * Date: 17-7-2016
 * Time: 15:07
 */

namespace Dizzy\Trakt\Response\Movies;


use Dizzy\Trakt\Media\AbstractMedia;
use Dizzy\Trakt\Response\Handlers\AbstractResponseHandler;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

class PeopleHandler extends AbstractResponseHandler
{

    /**
     * Handles a request
     * @todo Be less lazy and write this function...
     * @param ClientInterface $client
     * @param ResponseInterface $response
     * @return Collection|AbstractMedia
     */
    public function handle(ClientInterface $client, ResponseInterface $response)
    {
        $json = $this->getJson($response);

    }
}