<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

class ResultUrl
{
    /**
     * @var string|null
     */
    private $successURL;

    /**
     * @var string|null
     */
    private $pendingURL;

    /**
     * @var string|null
     */
    private $failureURL;

    /**
     * @var string|null
     */
    private $cancelURL;

    /**
     * @var string|null
     */
    private $errorURL;

    /**
     * @return string|null
     */
    public function getSuccessURL(): ?string
    {
        return $this->successURL;
    }

    /**
     * @param string|null $successURL
     * @return ResultUrl
     */
    public function setSuccessURL(?string $successURL): ResultUrl
    {
        $this->successURL = $successURL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPendingURL(): ?string
    {
        return $this->pendingURL;
    }

    /**
     * @param string|null $pendingURL
     * @return ResultUrl
     */
    public function setPendingURL(?string $pendingURL): ResultUrl
    {
        $this->pendingURL = $pendingURL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFailureURL(): ?string
    {
        return $this->failureURL;
    }

    /**
     * @param string|null $failureURL
     * @return ResultUrl
     */
    public function setFailureURL(?string $failureURL): ResultUrl
    {
        $this->failureURL = $failureURL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCancelURL(): ?string
    {
        return $this->cancelURL;
    }

    /**
     * @param string|null $cancelURL
     * @return ResultUrl
     */
    public function setCancelURL(?string $cancelURL): ResultUrl
    {
        $this->cancelURL = $cancelURL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getErrorURL(): ?string
    {
        return $this->errorURL;
    }

    /**
     * @param string|null $errorURL
     * @return ResultUrl
     */
    public function setErrorURL(?string $errorURL): ResultUrl
    {
        $this->errorURL = $errorURL;
        return $this;
    }
}
