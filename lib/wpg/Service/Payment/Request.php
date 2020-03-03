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
     * @var string|null
     */
    private $captureDelay;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var int
     */
    private $exponent;

    /**
     * @var string|null
     */
    private $paymentMethodMaskInclude;

    /**
     * @var string|null
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
    public function setOrderCode(string $orderCode): Request
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getInstallationId(): ?string
    {
        return $this->installationId;
    }

    /**
     * @param string null|$installationId
     * @return Request
     */
    public function setInstallationId(?string $installationId): Request
    {
        $this->installationId = $installationId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaptureDelay(): ?string
    {
        return $this->captureDelay;
    }

    /**
     * @param string|null $captureDelay
     * @return Request
     */
    public function setCaptureDelay(?string $captureDelay): Request
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
    public function setDescription(string $description): Request
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param float $floatAmount
     * @param int $exponent
     * @return Request
     */
    public function setAmount(float $floatAmount, int $exponent): Request
    {
        $amountStr = number_format($floatAmount, $exponent);
        list($amount, $fraction) = explode('.', $amountStr);
        $amount *= pow(10, $exponent);
        $amount += $fraction;

        $this->amount = $amount;
        $this->exponent = $exponent;

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
    public function setCurrencyCode(string $currencyCode): Request
    {
        $this->currencyCode = strtoupper($currencyCode);
        return $this;
    }

    /**
     * @return int
     */
    public function getExponent(): int
    {
        return $this->exponent;
    }

    /**
     * @param string $exponent
     * @return Request
     */
    public function setExponent(string $exponent): Request
    {
        $this->exponent = $exponent;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodMaskInclude(): ?string
    {
        return $this->paymentMethodMaskInclude;
    }

    /**
     * @param string|null $paymentMethodMaskInclude
     * @return Request
     */
    public function setPaymentMethodMaskInclude(?string $paymentMethodMaskInclude): Request
    {
        $this->paymentMethodMaskInclude = $paymentMethodMaskInclude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodMaskExclude(): ?string
    {
        return $this->paymentMethodMaskExclude;
    }

    /**
     * @param string|null $paymentMethodMaskExclude
     * @return Request
     */
    public function setPaymentMethodMaskExclude(?string $paymentMethodMaskExclude): Request
    {
        $this->paymentMethodMaskExclude = $paymentMethodMaskExclude;
        return $this;
    }
}
