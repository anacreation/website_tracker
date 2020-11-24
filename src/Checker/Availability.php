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

class Availability implements CheckerInterface
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
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch,
                                  CURLINFO_HTTP_CODE);


        return (($http_code == "200") || ($http_code == "302")) ?
            new Response($this,
                         true,
                         'successful'):
            new Response($this,
                         false,
                         'failed to get');

    }
}
