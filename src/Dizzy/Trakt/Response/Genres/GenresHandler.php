<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 22:08
 */

namespace Dizzy\Trakt\Response\Genres;

use Dizzy\Trakt\Api\Genres;
use Dizzy\Trakt\Media\AbstractMedia;
use Dizzy\Trakt\Media\Genre;
use Dizzy\Trakt\Response\AbstractResponseHandler;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Class GenresHandler
 * @package Dizzy\Trakt\Response\Genres
 */
class GenresHandler extends AbstractResponseHandler
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

        return $this->createGenres($client, $json);
    }

    /**
     * Generate a collection of genres.
     * @param ClientInterface $client
     * @param $json
     * @return Collection
     */
    private function createGenres(ClientInterface $client, $json)
    {
        $genres = new Collection();

        foreach ($json as $genre) {
            $genres->push(new Genre($client, new Genres($client), $genre));
        }

        return $genres;
    }
}