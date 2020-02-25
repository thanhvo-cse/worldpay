<?php
namespace Thanhvo\Worldpay\WPG;

use GuzzleHttp\RequestOptions;
use Thanhvo\Worldpay\Client as CommonClient;

class Client extends CommonClient
{
    const BASE_URL_TEST = 'https://secure-test.worldpay.com';
    const BASE_URL_LIVE = 'https://secure.worldpay.com';

    const MODE_TEST = 'test';
    const MODE_LIVE = 'live';

    const VERSION = '1.4';

    /**
     * @var string
     */
    protected $_contentType = 'text/xml; charset=UTF8';

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

        $authorisation = base64_encode(
            'HKAIRGPAHKD' . ':' . 'Live2019!'
        );

        $this->setHeader('Authorization', 'Basic ' . $authorisation);
    }

    public function post(
        string $uri,
        \SimpleXMLElement $data
    )
    {
        return parent::post($uri, $this->getBody($data), RequestOptions::BODY);
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
