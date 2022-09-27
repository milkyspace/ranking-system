<?php

namespace Ranking\RankingDatas;

use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class DataForConditionBuilder
 * @package Ranking
 */
final class DataForConditionBuilder
{
    private $id;
    private $rankCommonData;
    private $logger;

    /**
     * @param $id
     * @return void
     */
    public function addId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param IRankingCommonData $ranking
     * @return void
     */
    public function addCommonData(?IRankingCommonData $ranking = null): void
    {
        $this->rankCommonData = $ranking;
    }

    /**
     * @return mixed
     */
    public function getCommonData(): IRankingCommonData
    {
        return $this->rankCommonData;
    }

    /**
     * @param RankingLogger|null $logger
     */
    public function addLogger(?RankingLogger $logger = null): void
    {
        $this->logger = $logger;
    }

    /**
     * @return mixed
     */
    public function getLogger(): RankingLogger
    {
        return $this->logger;
    }
}