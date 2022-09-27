<?php

namespace Ranking\RankingTypes;

use Ranking\Interfaces\IRankingType;

/**
 * Class FirstRankingType
 * @package Ranking\RankingTypes
 */
final class FirstRankingType implements IRankingType
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'first';
    }
}