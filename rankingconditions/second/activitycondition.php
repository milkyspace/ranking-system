<?php

namespace Ranking\RankingConditions\Second;

use Bitrix\Main\Localization\Loc;
use Ranking\RankingConditions\Condition;
use Ranking\RankingDatas\FirstRankingCommonData;

/**
 * @example for Default Criteria
 *
 * Class ActivityCondition
 * @package Ranking\RankingConditions\Second
 */
final class ActivityCondition extends Condition
{
    /** @var $maxWeight int */
    public $maxWeight = 2;

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return Loc::getMessage('CONDITIONS_ACTIVITY_NAME');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return Loc::getMessage('CONDITIONS_ACTIVITY_DESCRIPTION');
    }

    /**
     * @return int
     */
    protected function process(): float
    {
        /** @var $rankingCommonData FirstRankingCommonData */
        $rankingCommonData = $this->rankCommonData;
        $lastActivityDate = $rankingCommonData->getExperts()[$this->id]['LAST_ACTIVITY_DATE'];
        if(!$lastActivityDate || $lastActivityDate === '') return 0;
        $dateOnline = strtotime($lastActivityDate);
        $before48Hours = strtotime('-48 hours');
        if($dateOnline > $before48Hours){
            return $this->maxWeight;
        }
        return 0;
    }
}