<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 00:30
 */

namespace Dizzy\Trakt\Media;
use Dizzy\Trakt\Api\Movies as MoviesEndpoint;
use GuzzleHttp\ClientInterface;

/**
 * Class Movie
 * @package Dizzy\Trakt\Media
 */
class Movie extends AbstractMedia
{
    /**
     * @var MoviesEndpoint;
     */
    protected $endpoint;

    /**
     * @var mixed
     */
    private $ids;

    /**
     * Movie constructor.
     * @param ClientInterface $client
     * @param MoviesEndpoint $endpoint
     * @param mixed $json
     */
    public function __construct(ClientInterface $client, MoviesEndpoint $endpoint, $json)
    {
        parent::__construct($client, $endpoint, $json);
    }

    /**
     * @return mixed
     */
    public function aliases()
    {
        return $this->endpoint->aliases($this->ids->trakt);
    }

    /**
     * @param null $sort
     * @return mixed
     */
    public function comments($sort = null)
    {
        return $this->endpoint->comments($this->ids->trakt, $sort);
    }

    /**
     * @return mixed
     */
    public function people()
    {
        return $this->endpoint->people($this->ids->trakt);
    }

    /**
     * @param null $country
     * @return mixed
     */
    public function releases($country = null)
    {
        return $this->endpoint->releases($this->ids->trakt, $country);
    }

    /**
     * @param null $country
     * @return mixed
     */
    public function translations($country = null)
    {
        return $this->endpoint->translations($this->ids->trakt, $country);
    }
}