<?php

namespace ThanhVo\Worldpay\WPG\Service;

use ThanhVo\Worldpay\Exception;
use ThanhVo\Worldpay\WPG\Client;
use ThanhVo\Worldpay\WPG\Service\Payment\Request;
use ThanhVo\Worldpay\WPG\Service\Payment\ResultUrl;

class Hosted
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $merchantCode;

    /**
     * Hosted constructor.
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
        $this->merchantCode = $username;
    }

    /**
     * @param Request $request
     * @param ResultUrl $resultUrl
     * @return string
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestPayment(Request $request, ResultUrl $resultUrl): string
    {
        $xml = $this->client->getPaymentXML();

        $order = $xml->addChild('submit')->addChild('order');
        $order->addAttribute('orderCode', $request->getOrderCode());
        $order->addAttribute('installationId', $request->getInstallationId());
        $order->addAttribute('captureDelay', $request->getCaptureDelay());

        $order->addChild('description', $request->getDescription());

        $amount = $order->addChild('amount');
        $amount->addAttribute('value', $request->getAmount());
        $amount->addAttribute('currencyCode', $request->getCurrencyCode());
        $amount->addAttribute('exponent', $request->getExponent());

        $paymentMethodMask = $order->addChild('paymentMethodMask');

        if (!empty($request->getPaymentMethodMaskInclude())) {
            $paymentMethodMask->addChild('include')
                ->addAttribute('code', $request->getPaymentMethodMaskInclude());
        }

        if (!empty($request->getPaymentMethodMaskExclude())) {
            $paymentMethodMask->addChild('exclude')
                ->addAttribute('code', $request->getPaymentMethodMaskExclude());
        }

        $response = $this->client->request(
            'post',
            'jsp/merchant/xml/paymentService.jsp',
            $xml
        );

        if (!empty($response->reply->error)) {
            throw new Exception($response->reply->error->__toString());
        }

        $redirectUrl = $response->reply->orderStatus->reference->__toString();
        if (!empty($resultUrl->getSuccessURL())) {
            $redirectUrl .= '&successURL=' . urlencode($resultUrl->getSuccessURL());
        }

        return $redirectUrl;
    }

    /**
     * @param string $macSecret
     * @param string $orderKey
     * @param string $amount
     * @param string $currency
     * @param string $paymentStatus
     * @return string
     */
    public function genMacSHA(
        string $macSecret,
        string $orderKey,
        string $amount,
        string $currency,
        string $paymentStatus
    )
    {
        return $this->genMac(
            'sha256',
            $macSecret,
            $orderKey,
            $amount,
            $currency,
            $paymentStatus
        );
    }

    /**
     * @param string $hashFunction
     * @param string $macSecret
     * @param string $orderKey
     * @param string $amount
     * @param string $currency
     * @param string $paymentStatus
     * @return string
     */
    private function genMac(
        string $hashFunction,
        string $macSecret,
        string $orderKey,
        string $amount,
        string $currency,
        string $paymentStatus
    )
    {
        $mac = "{$orderKey}:{$amount}:{$currency}:{$paymentStatus}";
        return hash_hmac($hashFunction, $mac, $macSecret);
    }
}
