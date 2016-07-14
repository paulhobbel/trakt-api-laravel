<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 01:11
 */

namespace Dizzy\Trakt;

use GuzzleHttp\ClientInterface;

/**
 * Class Trakt
 * @package Dizzy\Trakt
 */
class Trakt
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Trakt constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        if($client == null) {
            $this->client = TraktHttpClient::make();
        }
        $this->createEndpointsWrappers();
    }

    /**
     * Creates a wrapper for each endpoint and loads it.
     */
    private function createEndpointsWrappers()
    {

    }
}