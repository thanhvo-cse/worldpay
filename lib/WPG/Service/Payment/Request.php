<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

use ThanhVo\Worldpay\Exception;
use ThanhVo\Worldpay\WPG\Exponent;

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
     * @var string|null
     */
    private $dynamic3DS;

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
     * @throws Exception
     */
    public function getAmount(): int
    {
        $currencyCode = $this->getCurrencyCode();
        $exponentMgmt = new Exponent();
        $exponent = $exponentMgmt->getByCurrency($currencyCode);

        $floats = explode('.', $this->amount);
        $amount = $floats[0];
        $fraction = 0;
        $fractionLength = 0;
        if (count($floats) > 1) {
            $fraction = $floats[1];
            $fractionLength = strlen($fraction);
        }

        if ($exponent < $fractionLength) {
            throw new Exception(sprintf('Please make sure the amount exponent is equal or less than %s', $exponent));
        }

        $fraction *= pow(10, ($exponent - $fractionLength));
        $amount *= pow(10, $exponent);
        $amount += $fraction;
        $this->amount = $amount;
        $this->exponent = $exponent;

        return $this->amount;
    }

    /**
     * @param float $floatAmount
     * @return $this
     */
    public function setAmount(float $floatAmount): Request
    {
        $this->amount = $floatAmount;
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

    /**
     * @return string|null
     */
    public function getDynamic3DS(): ?string
    {
        return $this->dynamic3DS;
    }

    /**
     * @param string|null $dynamic3DS
     * @return Request
     */
    public function setDynamic3DS(?string $dynamic3DS): Request
    {
        $this->dynamic3DS = $dynamic3DS;
        return $this;
    }
}
