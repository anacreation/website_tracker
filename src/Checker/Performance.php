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
 * @package
 * @Date        : 28/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\StatusChecker\Checker;


use Anacreation\StatusChecker\Contract\CheckerInterface;

class Performance implements CheckerInterface
{

    public function check(string $url): Response {
        $timeout = 10;

        $ch = curl_init();

        curl_setopt($ch,
                    CURLOPT_URL,
                    $url);
        curl_setopt($ch,
                    CURLOPT_RETURNTRANSFER,
                    1);
        curl_setopt($ch,
                    CURLOPT_TIMEOUT,
                    $timeout);
        curl_exec($ch);
        return new Response($ch,
                            $this,
                            true);
    }
}
