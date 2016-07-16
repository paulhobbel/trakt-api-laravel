<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:33
 */

namespace Dizzy\Trakt\Contracts;


use Dizzy\Trakt\Media\AbstractMedia;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Interface ResponseHandlerInterface
 * @package Dizzy\Trakt\Contracts
 */
interface ResponseHandlerInterface
{
    /**
     * Handles a request
     * @param ClientInterface $client
     * @param ResponseInterface $response
     * @return Collection|AbstractMedia
     */
    public function handle(ClientInterface $client, ResponseInterface $response);
}