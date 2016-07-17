<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 12:00
 */

namespace Dizzy\Trakt\Media;
use Dizzy\Trakt\Contracts\EndpointInterface;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class AbstractMedia
 * @package Dizzy\Trakt\Media
 */
abstract class AbstractMedia implements Arrayable
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $json;

    /**
     * @var array
     */
    protected $media;

    /**
     * @var EndpointInterface
     */
    protected $endpoint;

    /**
     * AbstractMedia constructor.
     * @param ClientInterface $client
     * @param EndpointInterface $endpoint
     * @param mixed $json
     */
    public function __construct(ClientInterface $client, EndpointInterface $endpoint, $json)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->json = $json;

        $this->media = $this->getMedia($json);

        $this->setMediaFields();
    }

    /**
     * Gets the ids object.
     * @return array
     */
    public function getIds()
    {
        return $this->media->ids;
    }

    /**
     * Gets the slug.
     * @return mixed
     */
    public function getSlug()
    {
        return $this->getIds()->slug;
    }

    /**
     * Converts the media json to an array.
     * @return array
     */
    public function toArray()
    {
        return json_decode(json_encode($this->media), true);
    }

    /**
     * Checks the json.
     * @param $json
     * @return mixed
     */
    private function getMedia($json)
    {
        if(property_exists($json, "type")) {
            if ($this instanceof Episode) {
                return $json->episode;
            }
            if ($this instanceof Season) {
                return $json->season;
            }
            if ($this instanceof Movie) {
                return $json->movie;
            }
            if ($this instanceof Show) {
                return $json->show;
            }
            if ($this instanceof Person) {
                return $json->person;
            }
        }
        return $json;
    }

    /**
     * Creates fields for all the keys.
     */
    protected function setMediaFields()
    {
        foreach ($this->media as $key => $value) {
            $this->{$key} = $value;
        }
    }
}