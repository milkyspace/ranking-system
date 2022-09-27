<?php

namespace Ranking\RankingConditions\First;

use Ranking\RankingConditions\Condition;
use Ranking\RankingLogger\RankingLogger;

/**
 * Class NullCondition
 * @package Ranking\RankingConditions\First
 */
final class NullCondition extends Condition
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @return int
     */
    protected function process(): float
    {
        return 0;
    }

    /**
     * @param RankingLogger|null $logger
     * @return mixed
     */
    public function getWeight(?RankingLogger $logger = null): float
    {
        $weight = $this->process();
        return ($weight < $this->maxWeight) ? $weight : $this->maxWeight; // вес не может быть больше максимального
    }
}