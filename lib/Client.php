<?php

namespace Thanhvo\Worldpay;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

class Client
{
    /**
     * @var string
     */
    protected $_contentType;

    /**
     * @var HttpClient
     */
    protected $_client;

    /**
     * @var array
     */
    protected $_headers = [];

    /**
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $this->_client = new HttpClient(['base_uri' => $baseUri]);
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setHeader(string $key, string $value)
    {
        $this->_headers[$key] = $value;
        return $this;
    }

    /**
     * @param string $uri
     * @param mixed $params
     * @param string $paramFormat
     * @param string|null $contentType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $uri, mixed $params, string $paramFormat = RequestOptions::JSON, string $contentType = null)
    {
        return $this->request('get', $uri, $params, $paramFormat, $contentType);
    }

    /**
     * @param string $uri
     * @param mixed $params
     * @param string $paramFormat
     * @param string|null $contentType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $uri, mixed $params, string $paramFormat = RequestOptions::JSON, string $contentType = null)
    {
        return $this->request('post', $uri, $params, $paramFormat, $contentType);
    }

    /**
     * @param string $uri
     * @param mixed $params
     * @param string $paramFormat
     * @param string|null $contentType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(string $uri, mixed $params, string $paramFormat = RequestOptions::JSON, string $contentType = null)
    {
        return $this->request('put', $uri, $params, $paramFormat, $contentType);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param mixed $params
     * @param string $paramFormat
     * @param string|null $contentType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $uri, mixed $params, string $paramFormat, ?string $contentType)
    {
        $headers = $this->_headers;
        if (!empty($contentType)) {
            $headers['Content-Type'] = $contentType;
        } else {
            $headers['Content-Type'] = $this->_contentType;
        }

        return $this->_client->request($method, $uri, [
            RequestOptions::HEADERS => $headers,
            $paramFormat => $params,
            RequestOptions::VERIFY => false
        ]);
    }
}
