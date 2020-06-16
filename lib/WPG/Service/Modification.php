<?php

namespace ThanhVo\Worldpay\WPG\Service;

use ThanhVo\Worldpay\Exception;
use ThanhVo\Worldpay\WPG\Client;
use ThanhVo\Worldpay\WPG\Service\Payment\Request;
use ThanhVo\Worldpay\WPG\Service\Payment\ResultUrl;

class Modification
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Modification constructor.
     * @param string $username
     * @param string $password
     * @param string $mode
     */
    public function __construct(
        string $username,
        string $password,
        string $mode = Client::MODE_TEST
    )
    {
        $this->client = new Client($username, $password, $mode);
    }

    /**
     * @param Request $request
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refundDirect(Request $request)
    {
        $xml = $this->client->getPaymentXML();

        $order = $xml->addChild('modify')->addChild('orderModification');
        $order->addAttribute('orderCode', $request->getOrderCode());

        $amount = $order->addChild('refund')->addChild('amount');
        $amount->addAttribute('value', $request->getAmount());
        $amount->addAttribute('currencyCode', $request->getCurrencyCode());
        $amount->addAttribute('exponent', $request->getExponent());

        $response = $this->client->request(
            'post',
            'jsp/merchant/xml/paymentService.jsp',
            $xml
        );

        if (!empty($response->reply->error)) {
            throw new Exception($response->reply->error->__toString());
        }
    }

    /**
     * @param Request $request
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelRequest(Request $request)
    {
        $xml = $this->client->getPaymentXML();

        $order = $xml->addChild('modify')->addChild('orderModification');
        $order->addAttribute('orderCode', $request->getOrderCode());
        $order->addChild('cancel');

        $response = $this->client->request(
            'post',
            'jsp/merchant/xml/paymentService.jsp',
            $xml
        );

        if (!empty($response->reply->error)) {
            throw new Exception($response->reply->error->__toString());
        }
    }
}
