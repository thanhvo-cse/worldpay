<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

class PaymentStatus
{
    /**
     * @var string
     */
    private $status;
    
    public function __construct(string $status)
    {
        $this->status = $status;
    }
    
    /**
     * @return bool
     */
    public function isShopperCancelled(): bool
    {
        return $this->status === "SHOPPER_CANCELLED";
    }

    /**
     * @return bool
     */
    public function isSignedFormReceived(): bool
    {
        return $this->status === "SIGNED_FORM_RECEIVED";
    }

    /**
     * @return bool
     */
    public function isShopperRedirected(): bool
    {
        return $this->status === "SHOPPER_REDIRECTED";
    }

    /**
     * @return bool
     */
    public function isSentForAuthorisation(): bool
    {
        return $this->status === "SENT_FOR_AUTHORISATION";
    }

    /**
     * @return bool
     */
    public function isAuthorised(): bool
    {
        return $this->status === "AUTHORISED";
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->status === "ERROR";
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status === "CANCELLED";
    }

    /**
     * @return bool
     */
    public function isCaptured(): bool
    {
        return $this->status === "CAPTURED";
    }

    /**
     * @return bool
     */
    public function isCapturedFailed(): bool
    {
        return $this->status === "CAPTURE_FAILED";
    }

    /**
     * @return bool
     */
    public function isSettled(): bool
    {
        return $this->status === "SETTLED";
    }

    /**
     * @return bool
     */
    public function isSettledByMerchant(): bool
    {
        return $this->status === "SETTLED_BY_MERCHANT";
    }

    /**
     * @return bool
     */
    public function isChargedBack(): bool
    {
        return $this->status === "CHARGED_BACK";
    }

    /**
     * @return bool
     */
    public function isChargebackReversed(): bool
    {
        return $this->status === "CHARGEBACK_REVERSED";
    }

    /**
     * @return bool
     */
    public function isInformationRequested(): bool
    {
        return $this->status === "INFORMATION_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isInformationSupplied(): bool
    {
        return $this->status === "INFORMATION_SUPPLIED";
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->status === "EXPIRED";
    }

    /**
     * @return bool
     */
    public function isSentForRefund(): bool
    {
        return $this->status === "SENT_FOR_REFUND";
    }

    /**
     * @return bool
     */
    public function isRefundWebFormIssued(): bool
    {
        return $this->status === "REFUND_WEBFORM_ISSUED";
    }

    /**
     * @return bool
     */
    public function isRefunded(): bool
    {
        return $this->status === "REFUNDED";
    }

    /**
     * @return bool
     */
    public function isRefundedByMerchant(): bool
    {
        return $this->status === "REFUNDED_BY_MERCHANT";
    }

    /**
     * @return bool
     */
    public function isRefundReversed(): bool
    {
        return $this->status === "REFUND_REVERSED";
    }

    /**
     * @return bool
     */
    public function isRefused(): bool
    {
        return $this->status === "REFUSED";
    }

    /**
     * @return bool
     */
    public function isRefusedByBank(): bool
    {
        return $this->status === "REFUSED_BY_BANK";
    }

    /**
     * @return bool
     */
    public function isRefundFailed(): bool
    {
        return $this->status === "REFUND_FAILED";
    }

    /**
     * @return bool
     */
    public function isReversed(): bool
    {
        return $this->status === "REVERSED";
    }

    /**
     * @return bool
     */
    public function isRevokeRequested(): bool
    {
        return $this->status === "REVOKE_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isRevokeFailed(): bool
    {
        return $this->status === "REVOKE_FAILED";
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->status === "REVOKED";
    }

    /**
     * @return bool
     */
    public function isWaitingForAuthorisation(): bool
    {
        return $this->status === "WAITING_FOR_AUTHORISATION";
    }

    /**
     * @return bool
     */
    public function isPushRequested(): bool
    {
        return $this->status === "PUSH_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isPushPending(): bool
    {
        return $this->status === "PUSH_PENDING";
    }

    /**
     * @return bool
     */
    public function isPushApproved(): bool
    {
        return $this->status === "PUSH_APPROVED";
    }

    /**
     * @return bool
     */
    public function isPushRefused(): bool
    {
        return $this->status === "PUSH_REFUSED";
    }

    /**
     * @return bool
     */
    public function isPushSettled(): bool
    {
        return $this->status === "PUSH_SETTLED";
    }

    /**
     * @return bool
     */
    public function isPushReversed(): bool
    {
        return $this->status === "PUSH_REVERSED";
    }

    /**
     * @return bool
     */
    public function isSettlementReversed(): bool
    {
        return $this->status === "SETTLEMENT_REVERSED";
    }

    /**
     * @return bool
     */
    public function isVoided(): bool
    {
        return $this->status === "VOIDED";
    }

    /**
     * @return bool
     */
    public function isOrderCreated(): bool
    {
        return $this->status === "ORDER_CREATED";
    }

    /**
     * @return bool
     */
    public function isWaitingForShopper(): bool
    {
        return $this->status === "WAITING_FOR_SHOPPER";
    }

    /**
     * @return bool
     */
    public function isPullRequested(): bool
    {
        return $this->status === "PULL_REQUESTED";
    }

    /**
     * @return bool
     */
    public function isPullPending(): bool
    {
        return $this->status === "PULL_PENDING";
    }

    /**
     * @return bool
     */
    public function isPullApproved(): bool
    {
        return $this->status === "PULL_APPROVED";
    }

    /**
     * @return bool
     */
    public function isPullRefused(): bool
    {
        return $this->status === "PULL_REFUSED";
    }
}
