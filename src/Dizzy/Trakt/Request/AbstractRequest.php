<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:12
 */

namespace Dizzy\Trakt\Request;

use Dizzy\Trakt\Contracts\ResponseHandler;
use Illuminate\Support\Collection;

/**
 * Class AbstractRequest
 * @package Dizzy\Trakt\Request
 */
abstract class AbstractRequest
{
    /**
     * @var ResponseHandler
     */
    private $responseHandler;

    /**
     * @var Collection
     */
    private $queryParams;

    /**
     * AbstractRequest constructor.
     */
    public function __construct()
    {
        $this->queryParams = new Collection();
        $this->setResponseHandler(new DefaultResponseHandler());
    }

    private function setResponseHandler(ResponseHandler $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    /**
     * Sets the extended query param.
     * @param string $value
     * @return $this
     */
    public function setExtended($value)
    {
        $this->addQueryParam("extended", $value);
        return $this;
    }

    /**
     * Sets the page query param.
     * @param int $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->addQueryParam("page", $page);
        return $this;
    }

    /**
     * Sets the limit query param.
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->addQueryParam("limit", $limit);
        return $this;
    }

    /**
     * Adds query params to the query collection.
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addQueryParam($key, $value)
    {
        $this->queryParams->put($key, $value);
        return $this;
    }
}