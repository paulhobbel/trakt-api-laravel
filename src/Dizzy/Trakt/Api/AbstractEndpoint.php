<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 01:40
 */

namespace Dizzy\Trakt\Api;


use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;

/**
 * Class AbstractEndpoint
 * @package Dizzy\Trakt\Api
 */
abstract class AbstractEndpoint
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Collection
     */
    private $extended;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $limit = 10;

    /**
     * AbstractEndpoint constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->extended = Collection::make(['min']);

        // Makes it a little bit easier to inject other dependencies in endpoints.
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $class = $this->getDocClass($property->getDocComment());
            $this->{$name} = $class->newInstanceArgs($this->client);
        }
    }

    /**
     * Sets the requested page.
     * @param int $page
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Sets the limit of results.
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Extends the request with images.
     * @return $this
     */
    public function withImages()
    {
        // Check if we didn't extend it already.
        if(!$this->extended->contains('images')) {
            return $this->extend('images');
        }
        return $this;
    }

    /**
     * Extends the request with full.
     * @return $this
     */
    public function withFull()
    {
        // Check if we didn't extend it already.
        if(!$this->extended->contains('full')) {
            return $this->extend('full');
        }
        return $this;
    }

    /**
     * Adds levels to the extended parameter.
     * @param mixed $level
     * @return $this
     */
    private function extend($level)
    {
        $this->extended->forget(0);
        $this->extended->push($level);
        return $this;
    }

    protected function request()
    {

    }

    /**
     * Gets the ReflectionClass from the requested class in a doc comment.
     * @param $docComment
     * @return \ReflectionClass
     */
    private function getDocClass($docComment)
    {
        preg_match('/(?<=@var\s).+/', $docComment, $match);
        return new \ReflectionClass($match[0]);
    }
}