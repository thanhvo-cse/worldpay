<?php
namespace ThanhVo\Worldpay\WPG;

use GuzzleHttp\RequestOptions;
use ThanhVo\Worldpay\Client as CommonClient;
use ThanhVo\Worldpay\Event\Dispatcher;

class Client extends CommonClient
{
    use Dispatcher;

    /**
     * API version
     */
    const VERSION = '1.4';

    /**
     * Test api base url
     */
    const BASE_URL_TEST = 'https://secure-test.worldpay.com';

    /**
     * Live api base url
     */
    const BASE_URL_LIVE = 'https://secure.worldpay.com';

    /**
     * Mode test
     */
    const MODE_TEST = 'test';

    /**
     * Mode live
     */
    const MODE_LIVE = 'live';

    /**
     * Message content type
     */
    const CONTENT_TYPE = 'text/xml';

    /**
     * Event before request
     */
    const EVENT_BEFORE_REQUEST = 'before_request';

    /**
     * Event after response
     */
    const EVENT_AFTER_RESPONSE = 'after_response';

    /**
     * @var string
     */
    private $merchantCode;

    /**
     * Client constructor.
     * @param string $username
     * @param string $password
     * @param string $mode
     */
    public function __construct(string $username, string $password, string $mode)
    {
        if ($mode == self::MODE_LIVE) {
            parent::__construct(self::BASE_URL_LIVE);
        } else {
            parent::__construct(self::BASE_URL_TEST);
        }

        $this->authorize($username, $password);
        $this->merchantCode = $username;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $params
     * @return \SimpleXMLElement
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(
        string $method,
        string $uri,
        $params
    ): \SimpleXMLElement
    {
        $headers = $this->_headers;
        $headers['Content-Type'] = self::CONTENT_TYPE;

        $requestBody = $this->getBody($params);
        $this->dispatchEvent(static::EVENT_BEFORE_REQUEST, $requestBody);

        $response = $this->_client->request(
            $method,
            $uri,
            [
                RequestOptions::HEADERS => $headers,
                RequestOptions::BODY => $requestBody,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
            ]
        );

        $responseBody = $response->getBody()->getContents();
        $this->dispatchEvent(static::EVENT_AFTER_RESPONSE, $responseBody);

        return new \SimpleXMLElement($responseBody);
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getPaymentXML(): \SimpleXMLElement
    {
        $xml = new \SimpleXMLElement('<paymentService />');
        $xml->addAttribute('version', self::VERSION);
        $xml->addAttribute('merchantCode', $this->merchantCode);

        return $xml;
    }

    /**
     * @param string $username
     * @param string $password
     */
    private function authorize(string $username, string $password)
    {
        $authorisation = base64_encode("{$username}:{$password}");
        $this->setHeader('Authorization', 'Basic ' . $authorisation);
    }

    /**
     * @param \SimpleXMLElement $data
     * @return string
     */
    private function getBody(\SimpleXMLElement $data): string
    {
        $implementation = new \DOMImplementation();

        $dtd = $implementation->createDocumentType(
            'paymentService',
            '-//WorldPay//DTD WorldPay PaymentService v1//EN',
            'http://dtd.worldpay.com/paymentService_v1.dtd'
        );

        $document = $implementation->createDocument(null, '', $dtd);
        $document->encoding = 'utf-8';

        $node = $document->importNode(dom_import_simplexml($data), true);
        $document->appendChild($node);
        $xml = $document->saveXML();

        return $xml;
    }
}
