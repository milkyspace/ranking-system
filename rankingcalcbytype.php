<?php

namespace Ranking;

use Ranking\Interfaces\IRanking;
use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class RankingCalcByType
 * @package Ranking
 */
final class RankingCalcByType
{
    /** @var $ranking int */
    private $ranking = 0;

    /** @var $rankingProcess IRanking */
    protected $rankingProcess;

    /**
     * RankingCalcByType constructor.
     * @param IRanking $rankingProcess
     */
    public function __construct(IRanking $rankingProcess)
    {
        $this->rankingProcess = $rankingProcess;
    }

    /**
     * @param IRankingCommonData|null $rankCommonData
     * @param RankingLogger|null $logger
     */
    public function calcRanking(?IRankingCommonData $rankCommonData = null, ?RankingLogger $logger = null): void
    {
        $this->ranking = $this->rankingProcess->calcRanking($rankCommonData, $logger);
    }

    /**
     * @return int
     */
    public function getRanking(): int
    {
        return $this->ranking; // получаем рейтинг в текущей системе
    }
}