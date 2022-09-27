<?php

namespace Ranking\RankingConditions;

use Ranking\Interfaces\IRankingCommonData;
use Ranking\RankingDatas\DataForConditionBuilder;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class Condition
 * @package Ranking\RankingConditions
 */
abstract class Condition
{
    /** @var $maxWeight int */
    public $maxWeight = 0; // maximum weight

    /** @var $multiply bool */
    public $multiply = false; // multiplication

    /** @var $id int|null */
    protected $id = null;

    /** @var $rankCommonData IRankingCommonData|null */
    protected $rankCommonData = null; // incoming data

    /** @var $condition Condition */
    protected $condition;

    /** @var $logger RankingLogger */
    protected $logger = null;

    /**
     * Condition constructor.
     * @param Condition|null $condition
     * @param int|null $id
     * @param IRankingCommonData|null $rankCommonData
     * @param RankingLogger|null $logger
     */
    public function __construct(?Condition $condition = null, ?DataForConditionBuilder $build = null)
    {
        $this->condition = $condition;
        if($build) {
            $this->id = $build->getId();
            $this->rankCommonData = $build->getCommonData();
            $this->logger = $build->getLogger();
        }
    }

    /**
     * @return mixed
     */
    abstract public function getName(): string; // criteria name

    /**
     * @return mixed
     */
    abstract public function getDescription(): string; // description of the condition

    /**
     * @return int
     */
    abstract protected function process(): float; // calculation

    /**
     * Умножение
     */
    public function setMultiply(): void
    {
        $this->multiply = true;
    }

    /**
     * @param RankingLogger|null $logger
     * @return mixed
     */
    public function getWeight(): float
    {
        $weight = $this->process();

        if ($this->logger)
            $this->logger->add([
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'multiply' => $this->multiply,
                'weight' => ($weight < $this->maxWeight) ? $weight : $this->maxWeight,
            ]);

        if ($this->multiply === true) {
            return $this->condition->getWeight()
                * (($weight < $this->maxWeight) ? $weight : $this->maxWeight); // the weight cannot be more than the maximum
        }

        return $this->condition->getWeight()
            + (($weight < $this->maxWeight) ? $weight : $this->maxWeight); // the weight cannot be more than the maximum
    }
}