<?php

namespace Ranking\Cron;

use Controllers\FirstController;
use Entity\Firsts;
use Entity\FirstsTable;
use Ranking\Controllers\RankingController;
use Ranking\Interfaces\IRankingLanguage;
use Ranking\Ranking;
use Ranking\RankingLanguages\EnLanguage;
use Ranking\RankingLanguages\RuLanguage;
use Ranking\RankingLogger\RankingLogger;
use Ranking\RankingSystems\FirstEnRanking;
use Ranking\RankingSystems\FirstRuRanking;
use Ranking\RankingTypes\FirstRankingType;
use Ranking\RankingDatas\FirstRankingCommonData;

/**
 * Class RankingUpdate
 * @package Ranking\Agents
 */
class RankingUpdate
{
    /**
     * @param array $tours
     * @param bool $log
     * @return string
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectException
     */
    public static function execute($elements = [], $log = false)
    {
        $rank = new Ranking(new FirstRankingCommonData($elements));

        foreach ($elements as $element) {
            $rankingRuFirstController = new RankingController($element, new FirstRankingType(), new RuLanguage(), new RankingLogger());
            // Thus, we can count ratings by adding and excluding rating systems.
            $ranking = new FirstRuRanking();
            $ranking->setId($element);
            $rankingRuFirstController->addRankingSystem($ranking); // adding a rating system according to the first system
            $rank->addRankingController($rankingRuFirstController);

            $rankingEnFirstController = new RankingController($element, new FirstRankingType(), new EnLanguage(), new RankingLogger());
            $ranking = new FirstEnRanking();
            $ranking->setId($element);
            $rankingEnFirstController->addRankingSystem($ranking); // adding a rating system according to the first system
            $rank->addRankingController($rankingEnFirstController);
        }

        // process
        $ranks = $rank->calc();

        foreach ($ranks['calc'] as $id => $langs) {
            $update = [];
            foreach ($langs as $lang => $rank) {
                /** @var $_lang IRankingLanguage */
                $_lang = $rank['langObj'];
                $update[$_lang->getSqlField()] = $rank['rank'];
            }

            // update
            Firsts::updateItem($id, $update);
        }
    }
}