<?php

namespace Ranking\RankingConditions\First;

use Bitrix\Main\Localization\Loc;
use Ranking\RankingConditions\Condition;
use Ranking\RankingDatas\FirstRankingCommonData;

/**
 * @example for Default Criteria
 *
 * Class OrdersCondition
 * @package Ranking\RankingConditions\First
 */
final class OrdersCondition extends Condition
{
    /** @var $maxWeight int */
    public $maxWeight = 15;

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return Loc::getMessage('CONDITIONS_ORDERS_NAME');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return Loc::getMessage('CONDITIONS_ORDERS_DESCRIPTION');
    }

    /**
     * @return int
     */
    protected function process(): float
    {
        /** @var $rankingCommonData FirstRankingCommonData */
        $rankingCommonData = $this->rankCommonData;
        $tour = $rankingCommonData->getFirsts()[$this->id];

        // средняя конверсия из визита в бронирование по всем
        $conversionOfVisitOrder = $rankingCommonData->getConversionOfVisitOrder();
        if (!$conversionOfVisitOrder) {
            return $this->maxWeight;
        }

        // конверсия из визита в бронирование по
        $dFirstCtr = $tour['orders_count'] / $tour['popularity'];

        $percent = ($dFirstCtr * 100) / $conversionOfVisitOrder;

        if ($percent >= 90) {
            return $this->maxWeight;
        }

        if($percent >= 70 && $percent < 90){
            return 10;
        }

        if($percent >= 50 && $percent < 70){
            return 7;
        }

        if($percent >= 30 && $percent < 50){
            return 5;
        }

        if($percent < 30){
            return 0;
        }

        return 0;
    }
}