<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     anacreation/website_checker
 * @Date        : 24/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\StatusChecker\Checker;


use Anacreation\StatusChecker\Contract\CheckerInterface;

class Response
{
    private CheckerInterface $checker;
    private $ch;
    private bool $success;
    private string $message;
    private array $params;

    public function __construct(
        $ch,
        CheckerInterface $checker,
        bool $success,
        string $message = '',
        array $params = []) {
        $this->ch = $ch;
        $this->success = $success;
        $this->message = $message;
        $this->params = $params;
        $this->checker = $checker;
    }

    /**
     * @return \Anacreation\StatusChecker\Contract\CheckerInterface
     */
    public function getChecker(): \Anacreation\StatusChecker\Contract\CheckerInterface {
        return $this->checker;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getParams(): array {
        return $this->params;
    }

    public function getTotalTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_TOTAL_TIME);
    }

    public function getStartTransferTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_STARTTRANSFER_TIME);
    }

    public function getRedirectTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_REDIRECT_TIME);
    }

    public function getPertransferTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_PRETRANSFER_TIME);
    }

    public function getAppConnectTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_APPCONNECT_TIME);
    }

    public function getConnectTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_CONNECT_TIME);
    }

    public function getNameLookupTime(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_NAMELOOKUP_TIME);
    }

    public function getHttpCode(): float {
        return curl_getinfo($this->ch,
                            CURLINFO_HTTP_CODE);
    }
}
