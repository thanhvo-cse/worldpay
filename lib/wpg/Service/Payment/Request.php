<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

class Request
{
    /**
     * @var string
     */
    private $orderCode;

    /**
     * @var string
     */
    private $installationId;

    /**
     * @var string
     */
    private $captureDelay;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var string
     */
    private $exponent;

    /**
     * @var string
     */
    private $paymentMethodMaskInclude;

    /**
     * @var string
     */
    private $paymentMethodMaskExclude;

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     * @return Request
     */
    public function setOrderCode(string $orderCode): void
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstallationId(): string
    {
        return $this->installationId;
    }

    /**
     * @param string $installationId
     * @return Request
     */
    public function setInstallationId(string $installationId): void
    {
        $this->installationId = $installationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaptureDelay(): string
    {
        return $this->captureDelay;
    }

    /**
     * @param string $captureDelay
     * @return Request
     */
    public function setCaptureDelay(string $captureDelay): void
    {
        $this->captureDelay = $captureDelay;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Request
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return Request
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return Request
     */
    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getExponent(): string
    {
        return $this->exponent;
    }

    /**
     * @param string $exponent
     * @return Request
     */
    public function setExponent(string $exponent): void
    {
        $this->exponent = $exponent;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethodMaskInclude(): string
    {
        return $this->paymentMethodMaskInclude;
    }

    /**
     * @param string $paymentMethodMaskInclude
     * @return Request
     */
    public function setPaymentMethodMaskInclude(string $paymentMethodMaskInclude): void
    {
        $this->paymentMethodMaskInclude = $paymentMethodMaskInclude;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethodMaskExclude(): string
    {
        return $this->paymentMethodMaskExclude;
    }

    /**
     * @param string $paymentMethodMaskExclude
     * @return Request
     */
    public function setPaymentMethodMaskExclude(string $paymentMethodMaskExclude): void
    {
        $this->paymentMethodMaskExclude = $paymentMethodMaskExclude;
        return $this;
    }
}
