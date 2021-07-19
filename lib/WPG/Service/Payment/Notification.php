<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

class Notification
{

    /**
     * @var mixed
     */
    private $orderStatusEvent;

    /**
     * @var mixed
     */
    private $payment;

    /**
     * @var mixed
     */
    private $journal;

    public function __construct(string $response)
    {
        $data = new \SimpleXMLElement($response);
        $this->orderStatusEvent = $data->notify->orderStatusEvent;
        $this->payment = $this->orderStatusEvent->payment;
        $this->journal = $this->orderStatusEvent->journal;
    }

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderStatusEvent['orderCode']->__toString();
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->payment->paymentMethod->__toString();
    }

    /**
     * @return string
     */
    public function getLastEvent(): string
    {
        return $this->payment->lastEvent->__toString();
    }
}