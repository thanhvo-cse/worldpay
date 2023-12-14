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

    /**
     * @var PaymentStatus
     */
    private $lastEvent;

    /**
     * @var PaymentStatus
     */
    private $journalType;

    /**
     * Notification constructor.
     * @param string $response
     */
    public function __construct(string $response)
    {
        $data = new \SimpleXMLElement($response);
        $this->orderStatusEvent = $data->notify->orderStatusEvent;
        $this->payment = $this->orderStatusEvent->payment;
        $this->journal = $this->orderStatusEvent->journal;
        $this->lastEvent = new PaymentStatus($this->payment->lastEvent->__toString());
        $this->journalType = new PaymentStatus($this->orderStatusEvent->journal['journalType']->__toString());
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return mixed
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * @return PaymentStatus
     */
    public function getLastEvent(): PaymentStatus
    {
        return $this->lastEvent;
    }

    /**
     * @return PaymentStatus
     */
    public function getJournalType(): PaymentStatus
    {
        return $this->journalType;
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
     * @param $amount
     * @return float
     */
    private function getAmount($amount): float
    {
        $value = (int) $amount['value']->__toString();
        $exponent = (int) $amount['exponent']->__toString();

        return $value / pow(10, $exponent);
    }

    /**
     * @return float
     */
    public function getOriginalAmount(): float
    {
        return $this->getAmount($this->payment->amount);
    }

    /**
     * @return string
     */
    public function getOriginalCurrencyCode(): string
    {
        return $this->payment->amount['currencyCode']->__toString();
    }

    /**
     * @return string
     */
    public function getDebitCreditIndicator(): string
    {
        return $this->payment->amount['debitCreditIndicator']->__toString();
    }

    /**
     * @return float
     */
    public function getBalanceAmount(): float
    {
        return $this->getAmount($this->payment->balance->amount);
    }

    /**
     * @return string
     */
    public function getBalanceCurrencyCode(): string
    {
        return $this->payment->balance->amount['currencyCode']->__toString();
    }

    /**
     * @return string
     */
    public function getBalanceAccountType(): string
    {
        return $this->payment->balance['accountType']->__toString();
    }

    /**
     * @return mixed
     */
    public function getPaymentMethodDetail()
    {
        return $this->payment->paymentMethodDetail;
    }

    /**
     * @return mixed
     */
    public function getBookingDate()
    {
        return $this->journal->bookingDate;
    }

    /**
     * @return boolean
     */
    public function isValidIP($requestingIP)
    {
        // Reverse DNS lookup - the domain is *.worldpay.com
        $host = gethostbyaddr($requestingIP);
        return (bool) preg_match('/\.worldpay\.com$/', $host);
    }
}
