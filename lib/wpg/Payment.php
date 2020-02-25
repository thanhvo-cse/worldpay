<?php

namespace Thanhvo\Worldpay\WPG;

use Thanhvo\Worldpay\WPG\Client;

class Payment
{
    private $connection;

    public function __construct(string $mode = Client::MODE_TEST)
    {
        $this->connection = new Client($mode);
    }

    public function createOrder(array $order = [])
    {
        $this->connection->post(
            '/jsp/merchant/xml/paymentService.jsp',
            $this->getBody()
        );
    }

    public function getBody()
    {
        $data = new \SimpleXMLElement('<paymentService />');
        $data->addAttribute('version', self::VERSION);
        $data->addAttribute('merchantCode', 'HKAIRGPAHKD');

        $order = $data->addChild('submit')->addChild('order');
        $order->addAttribute('orderCode', '100');
        $order->addAttribute('installationId', '1339409');

        $order->addChild('description', 'Test description');

        $amount = $order->addChild('amount');
        $amount->addAttribute('value', '100');
        $amount->addAttribute('currencyCode', 'HKD');
        $amount->addAttribute('exponent', '2');

        return $data;
    }
}
