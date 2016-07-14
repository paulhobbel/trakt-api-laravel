<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:37
 */

namespace Dizzy\Trakt\Response\Handlers;

use Dizzy\Trakt\Contracts\ResponseHandler;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Class DefaultResponseHandler
 * @package Dizzy\Trakt\Response
 */
class DefaultResponseHandler extends AbstractResponseHandler implements ResponseHandler
{
    public function handle(ResponseInterface $response, ClientInterface $client)
    {
        // TODO: Implement handle() method.
    }
}