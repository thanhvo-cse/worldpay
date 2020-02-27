<?php

namespace ThanhVo\Worldpay\WPG\Service;

use ThanhVo\Worldpay\Exception;
use ThanhVo\Worldpay\WPG\Client;
use ThanhVo\Worldpay\WPG\Service\Payment\Request;
use ThanhVo\Worldpay\WPG\Service\Payment\ResultUrl;

class Payment
{
    const VERSION = '1.4';

    private $client;

    public function __construct(string $mode = Client::MODE_TEST)
    {
        $this->client = new Client($mode);
    }

    /**
     * @param Request $request
     * @param ResultUrl $resultUrl
     * @return string
     * @throws Exception
     */
    public function createOrder(
        Request $request,
        ResultUrl $resultUrl
    )
    {
        $response = $this->client->request(
            'post',
            'jsp/merchant/xml/paymentService.jsp',
            $this->getBody($request)
        );

        if (!empty($response->reply->error)) {
            throw new Exception($response->reply->error->__toString());
        }

        $redirectUrl = $response->reply->orderStatus->reference->__toString();
        if (!empty($resultUrl->getSuccessURL())) {
            $redirectUrl .= '&successUrl=' . $resultUrl->getSuccessURL();
        }

        return $redirectUrl;
    }

    public function getBody(Request $request)
    {
        $data = new \SimpleXMLElement('<paymentService />');
        $data->addAttribute('version', self::VERSION);
        $data->addAttribute('merchantCode', 'HKAIRGPAHKD');

        $order = $data->addChild('submit')->addChild('order');
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

        return $data;
    }
}
