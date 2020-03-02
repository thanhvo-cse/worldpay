<?php

namespace ThanhVo\Worldpay;

use GuzzleHttp\Client as HttpClient;

abstract class Client
{
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
}
