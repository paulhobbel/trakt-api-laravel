<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:46
 */

namespace Dizzy\Trakt\Response;

use Dizzy\Trakt\Contracts\ResponseHandlerInterface;
use Dizzy\Trakt\Media\AbstractMedia;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Class AbstractResponseHandler
 * @package Dizzy\Trakt\Response
 */
abstract class AbstractResponseHandler implements ResponseHandlerInterface
{
    protected function getJson(ResponseInterface $response)
    {
        return $response->json(["object" => true]);
    }

    /**
     * Create a new media object.
     * @param AbstractMedia $mediaObject
     * @param ClientInterface $client
     * @param $item
     * @return AbstractMedia
     */
    protected function createMediaObject(AbstractMedia $mediaObject, ClientInterface $client, $item)
    {
        return new $mediaObject($client, $item);
    }

    /**
     * Transforms a response interface to an array of media objects.
     * @param ResponseInterface $response
     * @param AbstractMedia $mediaObject
     * @param ClientInterface $client
     * @return array
     */
    protected function transformToMediaObjects(ResponseInterface $response, AbstractMedia $mediaObject, ClientInterface $client)
    {
        $objects = [];
        foreach($this->getJson($response) as $item) {
            $objects[] = $this->createMediaObject($mediaObject, $client, $item);
        }

        return $objects;
    }
}