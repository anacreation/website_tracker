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

namespace Anacreation\StatusChecker;


use Anacreation\StatusChecker\Contract\CheckerInterface;

class CheckerManager
{
    private string $url;

    /**
     * @var array [CheckerInterface]
     */
    public array $checkers;


    /**
     * StatusManager constructor.
     * @param string $url
     */
    public function __construct(string $url) {
        $this->url = $url;
    }

    public function addChecker(CheckerInterface $checker): CheckerManager {
        $this->checkers[] = $checker;

        return $this;
    }

    /**
     * @return array [Anacreation\StatusChecker\Checker\Response]
     */
    public function execute(): array {
        $results = [];
        foreach($this->checkers as $checker) {
            $results[] = [$checker->check($this->url),];
        }

        return $results;
    }
}
