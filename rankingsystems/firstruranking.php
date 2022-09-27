<?php

namespace Ranking\RankingSystems;

use Ranking\Interfaces\IRanking;
use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingConditions\Condition;
use Ranking\RankingConditions\First\ConversionCondition;
use Ranking\RankingConditions\First\FreePlacesCondition;
use Ranking\RankingConditions\First\GuaranteeCondition;
use Ranking\RankingConditions\First\Multiplying\RuFirstInDagestanCondition;
use Ranking\RankingConditions\First\Multiplying\RuFirstInRussiaCondition;
use Ranking\RankingConditions\First\Multiplying\WithoutDatesAndPlacesCondition;
use Ranking\RankingConditions\First\NullCondition;
use Ranking\RankingConditions\First\OrdersCondition;
use Ranking\RankingConditions\First\PriceCondition;
use Ranking\RankingConditions\First\RatingCondition;
use Ranking\RankingConditions\First\RegularCondition;
use Ranking\RankingConditions\First\Top10CountriesCondition;
use Ranking\RankingDatas\DataForConditionBuilder;
use Ranking\RankingDatas\FirstRankingCommonData;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class FirstRuRanking
 * @package Ranking\RankingSystems
 */
final class FirstRuRanking extends Condition implements IRanking
{
    /** @var $id int */
    protected $id;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param IRankingCommonData|null $rankCommonData
     * @param RankingLogger|null $logger
     * @return int
     */
    public function calcRanking(?IRankingCommonData $rankCommonData = null, ?RankingLogger $logger = null): int
    {
        /** @var $rankingCommonData FirstRankingCommonData */

        // таким образом мы можем считать рейтинги, включая и исключая условия для разных случаев
        $build = new DataForConditionBuilder();
        $build->addId($this->id);
        $build->addCommonData($rankCommonData);
        $build->addLogger($logger);

        $ranking = new NullCondition(null, $build);
        $ranking = new OrdersCondition($ranking, $build);
        $ranking = new PriceCondition($ranking, $build);
        $ranking = new FreePlacesCondition($ranking, $build);
        $ranking = new Top10CountriesCondition($ranking, $build);
        $ranking = new ConversionCondition($ranking, $build);
        $ranking = new RatingCondition($ranking, $build);
        $ranking = new GuaranteeCondition($ranking, $build);
        $ranking = new RegularCondition($ranking, $build);

        // Multiplying additional criteria
        $ranking = new WithoutDatesAndPlacesCondition($ranking, $build);
        $ranking->setMultiply();
        $ranking = new RuFirstInDagestanCondition($ranking, $build);
        $ranking->setMultiply();
        $ranking = new RuFirstInRussiaCondition($ranking, $build);
        $ranking->setMultiply();

        // Композицией добавляем другую систему ранкинга: ранкинг тревел-эксперта
        $ranking = new SecondRuRanking($ranking, $build);

        return $ranking->getWeight();
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return 'FirstNameRu';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'FirstDescRu';
    }

    /**
     * @return int
     */
    protected function process(): float
    {
        return 0;
    }
}