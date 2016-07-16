<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 01:11
 */

namespace Dizzy\Trakt;

use Dizzy\Trakt\Api\Genres;
use Dizzy\Trakt\Api\Movies;
use Dizzy\Trakt\Api\People;
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
     * @var Movies
     */
    public $movies;

    /**
     * @var People
     */
    public $people;

    /**
     * @var Genres
     */
    public $genres;

    /**
     * Some magic works to let Facade's work correctly.
     * Trakt::endpoint doesn't work, but Trakt::endpoint() works
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     *
     */
    public function __call($name, $arguments)
    {
        return $this->{$name};
    }

    /**
     * Trakt constructor.
     */
    public function __construct()
    {
        $this->client = TraktHttpClient::make();
        $this->createEndpointsWrappers();
    }

    /**
     * Creates a wrapper for each endpoint and loads it.
     */
    private function createEndpointsWrappers()
    {
        $this->movies = new Movies($this->client);
        $this->people = new People($this->client);
        $this->genres = new Genres($this->client);
    }
}
