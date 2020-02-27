<?php

namespace ThanhVo\Worldpay\WPG\Service\Payment;

class ResultUrl
{
    /**
     * @var string
     */
    private $successURL;

    /**
     * @var string
     */
    private $pendingURL;

    /**
     * @var string
     */
    private $failureURL;

    /**
     * @var string
     */
    private $cancelURL;

    /**
     * @var string
     */
    private $errorURL;

    /**
     * @return string
     */
    public function getSuccessURL(): string
    {
        return $this->successURL;
    }

    /**
     * @param string $successURL
     * @return ResultUrl
     */
    public function setSuccessURL(string $successURL): void
    {
        $this->successURL = $successURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getPendingURL(): string
    {
        return $this->pendingURL;
    }

    /**
     * @param string $pendingURL
     * @return ResultUrl
     */
    public function setPendingURL(string $pendingURL): void
    {
        $this->pendingURL = $pendingURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getFailureURL(): string
    {
        return $this->failureURL;
    }

    /**
     * @param string $failureURL
     * @return ResultUrl
     */
    public function setFailureURL(string $failureURL): void
    {
        $this->failureURL = $failureURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancelURL(): string
    {
        return $this->cancelURL;
    }

    /**
     * @param string $cancelURL
     * @return ResultUrl
     */
    public function setCancelURL(string $cancelURL): void
    {
        $this->cancelURL = $cancelURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorURL(): string
    {
        return $this->errorURL;
    }

    /**
     * @param string $errorURL
     * @return ResultUrl
     */
    public function setErrorURL(string $errorURL): void
    {
        $this->errorURL = $errorURL;
        return $this;
    }
}
