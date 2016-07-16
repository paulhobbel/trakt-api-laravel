<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 17-7-2016
 * Time: 00:45
 */

namespace Dizzy\Trakt\Response\People;

use Dizzy\Trakt\Media\AbstractMedia;
use Dizzy\Trakt\Media\Person;
use Dizzy\Trakt\Response\Handlers\AbstractResponseHandler;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Class SummaryHandler
 * @package Dizzy\Trakt\Response\People
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

        return new Person($json);
    }
}