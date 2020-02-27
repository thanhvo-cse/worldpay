<?php
namespace ThanhVo\Worldpay\WPG;

use GuzzleHttp\RequestOptions;
use ThanhVo\Worldpay\Client as CommonClient;

class Client extends CommonClient
{
    const BASE_URL_TEST = 'https://secure-test.worldpay.com';
    const BASE_URL_LIVE = 'https://secure.worldpay.com';

    const MODE_TEST = 'test';
    const MODE_LIVE = 'live';

    const CONTENT_TYPE = 'text/xml';

    /**
     * Client constructor.
     * @param string $mode
     */
    public function __construct(string $mode)
    {
        if ($mode == self::MODE_LIVE) {
            parent::__construct(self::BASE_URL_LIVE);
        } else {
            parent::__construct(self::BASE_URL_TEST);
        }

        $this->authorize();
    }

    public function request(
        string $method,
        string $uri,
        $params
    )
    {
        $headers = $this->_headers;
        $headers['Content-Type'] = self::CONTENT_TYPE;

        $response = $this->_client->request(
            $method,
            $uri,
            [
                RequestOptions::HEADERS => $headers,
                RequestOptions::BODY => $this->getBody($params),
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
            ]
        );

        return new \SimpleXMLElement($response->getBody()->getContents());
    }

    private function authorize()
    {
        $authorisation = base64_encode(
            'HKAIRGPAHKD' . ':' . 'Live2019!'
        );

        $this->setHeader('Authorization', 'Basic ' . $authorisation);
    }

    /**
     * @param \SimpleXMLElement $data
     * @return string
     */
    private function getBody(\SimpleXMLElement $data)
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
