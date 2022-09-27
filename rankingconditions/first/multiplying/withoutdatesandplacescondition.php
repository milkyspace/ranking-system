<?php

namespace Ranking\RankingConditions\First\Multiplying;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\DateTime;
use Ranking\RankingConditions\Condition;
use Ranking\RankingDatas\FirstRankingCommonData;

/**
 * @example for Multiplying Criteria
 *
 * Class WithoutDatesAndPlacesCondition
 * @package Ranking\RankingConditions\First\Multiplying
 */
final class WithoutDatesAndPlacesCondition extends Condition
{
    /** @var $maxWeight int */
    public $maxWeight = 1;

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return Loc::getMessage('CONDITIONS_WITHOUTDATESANDPLACES_NAME');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return Loc::getMessage('CONDITIONS_WITHOUTDATESANDPLACES_DESCRIPTION');
    }

    /**
     * @return int
     * @throws \Exception
     */
    protected function process(): float
    {
        /** @var $rankingCommonData FirstRankingCommonData */
        $rankingCommonData = $this->rankCommonData;
        $tour = $rankingCommonData->getFirsts()[$this->id];

        if(!$tour['trip_dates']['active_date_free_spaces']){
            return 0;
        }

        [$maxAvailable, $_] = explode('/', $tour['trip_dates']['active_date_free_spaces']);

        if ($tour['trip_dates']['hasActiveDate'] !== true && $maxAvailable === '0'){
            return 0;
        }

        return 1;
    }
}