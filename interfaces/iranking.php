<?php

namespace Ranking\Interfaces;

use Ranking\RankingLogger\RankingLogger;

/**
 * Interface IRanking
 * @package Ranking\Interfaces
 */
interface IRanking
{
    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @param IRankingCommonData|null $rankCommonData
     * @param RankingLogger|null $logger
     * @return int
     */
    public function calcRanking(?IRankingCommonData $rankCommonData = null, ?RankingLogger $logger = null): int;
}