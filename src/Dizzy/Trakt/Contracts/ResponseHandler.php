<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:33
 */

namespace Dizzy\Trakt\Contracts;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Interface ResponseHandler
 * @package Dizzy\Trakt\Contracts
 */
interface ResponseHandler
{
    /**
     * Handles a request
     * @param ResponseInterface $response
     * @param ClientInterface $client
     * @return mixed
     */
    public function handle(ResponseInterface $response, ClientInterface $client);
}