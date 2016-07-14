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
     * @param ClientInterface $client
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handle(ClientInterface $client, ResponseInterface $response);
}