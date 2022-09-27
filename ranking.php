<?php

namespace Ranking;

use Ranking\Controllers\RankingController;
use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingLanguages\EnLanguage;
use Ranking\RankingLanguages\RuLanguage;
use Ranking\RankingTypes\FirstRankingType;

/**
 * Class Ranking
 * @package Ranking
 */
final class Ranking
{
    /** @var $toCalculate array */
    private $toCalculate;

    /** @var $commonData IRankingCommonData */
    private $commonData;

    /**
     * Ranking constructor.
     * All general information received earlier in Main\Agents\Statistic\FirstRanking::calcRatingFirst()
     * @param IRankingCommonData $innerCommondata
     */
    public function __construct(IRankingCommonData $innerCommondata)
    {
        $this->commonData = $innerCommondata;
        $this->commonData->processData();
    }

    /**
     * @param RankingController $rankingController
     */
    public function addRankingController(RankingController $rankingController): void
    {
        $this->toCalculate[] = $rankingController;
    }

    /**
     * @return array
     */
    public function calc(): array
    {
        $calc = [];
        $loggers = [];
        foreach ($this->toCalculate as $controller) {
            /** @var $controller RankingController */

            $calc[$controller->getId()][$controller->getLanguage()->getCode()] = [
                'rank' => $controller->calcRanking($this->commonData),
                'langObj' => $controller->getLanguage(),
            ];

            $loggers[$controller->getLanguage()->getCode()][$controller->getType()][$controller->getId()] = $controller->getLogger()->getLog();
        }

        return [
            'calc' => $calc,
            'log' => $loggers,
        ];
    }
}