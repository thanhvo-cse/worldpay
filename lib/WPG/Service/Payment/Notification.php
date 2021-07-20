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
     * @var string
     */
    private $lastEvent;

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
        $this->lastEvent = $this->payment->lastEvent->__toString();
    }

    /**
     * @return bool
     */
    public function isShopperCancelled(): bool
    {
        return $this->lastEvent === "SHOPPER_CANCELLED";
    }

    /**
     * @return bool
     */
    public function isSignedFormReceived(): bool
    {
        return $this->lastEvent === "SIGNED_FORM_RECEIVED";
    }

    /**
     * @return bool
     */
    public function isShopperRedirected(): bool
    {
        return $this->lastEvent === "SHOPPER_REDIRECTED";
    }

    /**
     * @return bool
     */
    public function isSentForAuthorisation(): bool
    {
        return $this->lastEvent === "SENT_FOR_AUTHORISATION";
    }

    /**
     * @return bool
     */
    public function isAuthorised(): bool
    {
        return $this->lastEvent === "AUTHORISED";
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->lastEvent === "ERROR";
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->lastEvent === "CANCELLED";
    }

    /**
     * @return bool
     */
    public function isCaptured(): bool
    {
        return $this->lastEvent === "CAPTURED";
    }

    /**
     * @return bool
     */
    public function isCapturedFailed(): bool
    {
        return $this->lastEvent === "CAPTURE_FAILED";
    }

    /**
     * @return bool
     */
    public function isSettled(): bool
    {
        return $this->lastEvent === "SETTLED";
    }

    /**
     * @return bool
     */
    public function isSettledByMerchant(): bool
    {
        return $this->lastEvent === "SETTLED_BY_MERCHANT";
    }

    /**
     * @return bool
     */
    public function isChargedBack(): bool
    {
        return $this->lastEvent === "CHARGED_BACK";
    }

    /**
     * @return bool
     */
    public function isChargebackReversed(): bool
    {
        return $this->lastEvent === "CHARGEBACK_REVERSED";
    }

    /**
     * @return bool
     */
    public function isInformationRequested(): bool
    {
        return $this->lastEvent === "INFORMATION_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isInformationSupplied(): bool
    {
        return $this->lastEvent === "INFORMATION_SUPPLIED";
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->lastEvent === "EXPIRED";
    }

    /**
     * @return bool
     */
    public function isSentForRefund(): bool
    {
        return $this->lastEvent === "SENT_FOR_REFUND";
    }

    /**
     * @return bool
     */
    public function isRefundWebFormIssued(): bool
    {
        return $this->lastEvent === "REFUND_WEBFORM_ISSUED";
    }

    /**
     * @return bool
     */
    public function isRefunded(): bool
    {
        return $this->lastEvent === "REFUNDED";
    }

    /**
     * @return bool
     */
    public function isRefundedByMerchant(): bool
    {
        return $this->lastEvent === "REFUNDED_BY_MERCHANT";
    }

    /**
     * @return bool
     */
    public function isRefundReversed(): bool
    {
        return $this->lastEvent === "REFUND_REVERSED";
    }

    /**
     * @return bool
     */
    public function isRefused(): bool
    {
        return $this->lastEvent === "REFUSED";
    }

    /**
     * @return bool
     */
    public function isRefusedByBank(): bool
    {
        return $this->lastEvent === "REFUSED_BY_BANK";
    }

    /**
     * @return bool
     */
    public function isRefundFailed(): bool
    {
        return $this->lastEvent === "REFUND_FAILED";
    }

    /**
     * @return bool
     */
    public function isReversed(): bool
    {
        return $this->lastEvent === "REVERSED";
    }

    /**
     * @return bool
     */
    public function isRevokeRequested(): bool
    {
        return $this->lastEvent === "REVOKE_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isRevokeFailed(): bool
    {
        return $this->lastEvent === "REVOKE_FAILED";
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->lastEvent === "REVOKED";
    }

    /**
     * @return bool
     */
    public function isWaitingForAuthorisation(): bool
    {
        return $this->lastEvent === "WAITING_FOR_AUTHORISATION";
    }

    /**
     * @return bool
     */
    public function isPushRequested(): bool
    {
        return $this->lastEvent === "PUSH_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isPushPending(): bool
    {
        return $this->lastEvent === "PUSH_PENDING";
    }

    /**
     * @return bool
     */
    public function isPushApproved(): bool
    {
        return $this->lastEvent === "PUSH_APPROVED";
    }

    /**
     * @return bool
     */
    public function isPushRefused(): bool
    {
        return $this->lastEvent === "PUSH_REFUSED";
    }

    /**
     * @return bool
     */
    public function isPushSettled(): bool
    {
        return $this->lastEvent === "PUSH_SETTLED";
    }

    /**
     * @return bool
     */
    public function isPushReversed(): bool
    {
        return $this->lastEvent === "PUSH_REVERSED";
    }

    /**
     * @return bool
     */
    public function isSettlementReversed(): bool
    {
        return $this->lastEvent === "SETTLEMENT_REVERSED";
    }

    /**
     * @return bool
     */
    public function isVoided(): bool
    {
        return $this->lastEvent === "VOIDED";
    }

    /**
     * @return bool
     */
    public function isOrderCreated(): bool
    {
        return $this->lastEvent === "ORDER_CREATED";
    }

    /**
     * @return bool
     */
    public function isWaitingForShopper(): bool
    {
        return $this->lastEvent === "WAITING_FOR_SHOPPER";
    }

    /**
     * @return bool
     */
    public function isPullRequested(): bool
    {
        return $this->lastEvent === "PULL_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isPullPending(): bool
    {
        return $this->lastEvent === "PULL_PENDING";
    }

    /**
     * @return bool
     */
    public function isPullApproved(): bool
    {
        return $this->lastEvent === "PULL_APPROVED";
    }

    /**
     * @return bool
     */
    public function isPullRefused(): bool
    {
        return $this->lastEvent === "PULL_REFUSED";
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
     * @return string
     */
    public function getJournalType(): string
    {
        return $this->journal['journalType']->__toString();
    }

    /**
     * @return mixed
     */
    public function getBookingDate()
    {
        return $this->journal->bookingDate;
    }
}
