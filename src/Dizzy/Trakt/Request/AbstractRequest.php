<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 11:12
 */

namespace Dizzy\Trakt\Request;

use Dizzy\Trakt\Contracts\ResponseHandlerInterface;
use Dizzy\Trakt\Exceptions\HttpCodeException\StatusCodeFactory;
use Dizzy\Trakt\Response\Handlers\DefaultResponseHandler;
use Dizzy\Trakt\TraktHttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Class AbstractRequest
 * @package Dizzy\Trakt\Request
 */
abstract class AbstractRequest implements \Dizzy\Trakt\Contracts\RequestInterface
{
    /**
     * @var ResponseHandlerInterface
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

    /**
     * Sets the current response handler.
     * @param ResponseHandlerInterface $responseHandler
     */
    protected function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    /**
     * Gets the current response handler.
     * @return ResponseHandlerInterface
     */
    private function getResponseHandler()
    {
        return $this->responseHandler;
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

    /**
     * @param ClientInterface $client
     * @param ResponseHandlerInterface|null $responseHandler
     * @return mixed
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\BadRequestException
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\ServerErrorException
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\ServerUnavailableException
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\StatusCodeException
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\UnauthorizedException
     * @throws \Dizzy\Trakt\Exceptions\HttpCodeException\UnprocessableEntityException
     */
    public function make(ClientInterface $client, ResponseHandlerInterface $responseHandler = null)
    {
        if($responseHandler) $this->setResponseHandler($responseHandler);

        $request = $this->createRequest($client);

        $response = $this->send($client, $request);

        if($this->notSuccessful($response)) {
            throw StatusCodeFactory::create($response->getStatusCode());
        }

        return $this->handleResponse($client, $response);
    }

    private function needsPostBody()
    {
        return in_array($this->getRequestType(), [RequestType::PUT, RequestType::POST]);
    }

    /**
     * Formats the url.
     * @return string
     */
    public function getUrl()
    {
        return UriBuilder::format($this);
    }

    /**
     * Creates a options array.
     * @return array
     */
    public function getOptions()
    {
        $options =  [
            "headers" => $this->getHeaders(),
            "query" => $this->queryParams->toArray()
        ];

        if($this->needsPostBody()) {
            $options['body'] = json_encode($this->getPostBody());
        }

        return $options;
    }

    /**
     * Creates the header array.
     * @return array
     */
    public function getHeaders()
    {
        return [
            "Content-Type" => "application/json",
            "trakt-api-version" => TraktHttpClient::API_VERSION,
            "trakt-api-key" => config('trakt.client_id')
        ];
    }

    /**
     * Creates a request.
     * @param ClientInterface $client
     * @return RequestInterface
     */
    private function createRequest(ClientInterface $client)
    {
        $request = $client->createRequest(
            $this->getRequestType(),
            $this->getUrl(),
            $this->getOptions()
        );

        return $request;
    }

    /**
     * Sends the given request using the client.
     * @param ClientInterface $client
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    private function send(ClientInterface $client, RequestInterface $request)
    {
        try {
            $response = $client->send($request);
            return $response;
        } catch (ServerException $exception) {
            $response = $exception->getResponse();
            return $response;
        }
    }

    private function handleResponse(ClientInterface $client, ResponseInterface $response)
    {
        $handler = $this->getResponseHandler();

        return $handler->handle($client, $response);
    }

    /**
     * Checks if a request was successful by checking the response.
     * @param ResponseInterface $response
     * @return bool
     */
    private function notSuccessful(ResponseInterface $response)
    {
        return (!in_array($response->getStatusCode(), [200, 201, 204, 504]));
    }

    /**
     * The default post body (should be overridden by the Request).
     * @return array
     */
    public function getPostBody()
    {
        return [];
    }
}