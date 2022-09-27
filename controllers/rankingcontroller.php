<?php

namespace Ranking\Controllers;

use Ranking\Interfaces\IRanking;
use Ranking\Interfaces\IRankingCommonData;
use Ranking\Interfaces\IRankingLanguage;
use Ranking\Interfaces\IRankingType;
use Ranking\RankingCalcByType;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class RankingController
 * @package Ranking\Controllers
 */
final class RankingController
{
    /** @var $rankingSystem array */
    private $rankingSystem = [];

    /** @var $id int */
    private $id;

    /** @var $type IRankingType */
    private $type;

    /** @var $language IRankingLanguage */
    private $language;

    /** @var $language RankingLogger */
    private $logger;

    /**
     * RankingController constructor.
     * @param int $id
     * @param IRankingType $type
     * @param IRankingLanguage $language
     * @param RankingLogger $logger
     */
    public function __construct(int $id, IRankingType $type, IRankingLanguage $language, RankingLogger $logger)
    {
        $this->id = $id;
        $this->type = $type;
        $this->language = $language;
        $this->logger = $logger;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type->getCode();
    }

    /**
     * @return IRankingLanguage
     */
    public function getLanguage(): IRankingLanguage
    {
        return $this->language;
    }

    /**
     * @param IRanking $rankingSystem
     */
    public function addRankingSystem(IRanking $rankingSystem): void
    {
        $this->rankingSystem[] = $rankingSystem;
    }

    /**
     * @return RankingLogger
     */
    public function getLogger(): RankingLogger
    {
        return $this->logger;
    }

    /**
     * @param IRankingCommonData|null $rankCommonData
     * @return int
     */
    public function calcRanking(?IRankingCommonData $rankCommonData = null): int
    {
        foreach ($this->rankingSystem as $rankingSystem){
            $ranking = new RankingCalcByType($rankingSystem);
            $ranking->calcRanking($rankCommonData, $this->logger);
            $rankings[] = $ranking->getRanking(); // проходим по всем системам рейтинга и собираем значения
        }
        $sum = array_sum($rankings);

        return $sum/count($rankings); // среднее арифметическое
    }
}