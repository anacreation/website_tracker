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

namespace Anacreation\StatusChecker\Contract;


use Anacreation\StatusChecker\Checker\Response;

interface CheckerInterface
{
    public function check(string $url): Response;
}
