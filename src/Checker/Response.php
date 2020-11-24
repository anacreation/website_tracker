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
    private bool $success;
    private string $message;
    private array $params;

    public function __construct(
        CheckerInterface $checker,
        bool $success,
        string $message = '',
        array $params = []) {
        $this->success = $success;
        $this->message = $message;
        $this->params = $params;
        $this->checker = $checker;
    }
}
