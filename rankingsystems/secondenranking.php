<?php

namespace Ranking\RankingSystems;

use Bitrix\Main\Localization\Loc;
use Ranking\Interfaces\IRanking;
use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingConditions\Condition;
use Ranking\RankingConditions\Second\ActivityCondition;
use Ranking\RankingConditions\Second\CancellationCondition;
use Ranking\RankingConditions\Second\ContactsExchangeCondition;
use Ranking\RankingConditions\Second\ConversionCondition;
use Ranking\RankingConditions\Second\RatingCondition;
use Ranking\RankingConditions\Second\ReviewsAnswersCondition;
use Ranking\RankingConditions\Second\ReviewsCountCondition;
use Ranking\RankingConditions\Second\SpeedCondition;
use Ranking\RankingConditions\Second\SecondrmCondition;
use Ranking\RankingConditions\Second\FirstsCountCondition;
use Ranking\RankingConditions\First\NullCondition;
use Ranking\RankingDatas\DataForConditionBuilder;
use Ranking\RankingDatas\FirstRankingCommonData;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class SecondEnRanking
 * @package Ranking\RankingSystems
 */
final class SecondEnRanking extends Condition implements IRanking
{
    /** @var $maxWeight int */
    public $maxWeight = 70;

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
        if(!$rankCommonData) return 0;

        /** @var $rankCommonData FirstRankingCommonData */
        // таким образом мы можем считать рейтинги, включая и исключая условия для разных случаев
        $expertId = (int) $rankCommonData->getFirsts()[$this->id]['expert_id'];

        $build = new DataForConditionBuilder();
        $build->addId($expertId);
        $build->addCommonData($rankCommonData);
        $build->addLogger($logger);

        $ranking = new NullCondition();
        $ranking = new ActivityCondition($ranking, $build);
        $ranking = new SpeedCondition($ranking, $build);
        $ranking = new ConversionCondition($ranking, $build);
        $ranking = new FirstsCountCondition($ranking, $build);
        $ranking = new SecondrmCondition($ranking, $build);
        $ranking = new ReviewsAnswersCondition($ranking, $build);
        $ranking = new ReviewsCountCondition($ranking, $build);
        $ranking = new RatingCondition($ranking, $build);
        $ranking = new ContactsExchangeCondition($ranking, $build);
        $ranking = new CancellationCondition($ranking, $build);

        return $ranking->getWeight();
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return 'SecondNameRu';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'SecondDescRu';
    }

    /**
     * @return int
     */
    protected function process(): float
    {
        return $this->calcRanking($this->rankCommonData, $this->logger);
    }
}