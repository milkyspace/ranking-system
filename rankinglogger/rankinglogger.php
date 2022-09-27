<?php

namespace Ranking\RankingLogger;

/**
 * Class RankingLogger
 * @package Ranking\RankingLogger
 */
final class RankingLogger
{
    private $log = [];

    /**
     * @param array $log
     * @return void
     */
    public function add(array $log): void
    {
        $this->log[] = $log;
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }
}