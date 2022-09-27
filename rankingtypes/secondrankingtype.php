<?php

namespace Ranking\RankingTypes;

use Ranking\Interfaces\IRankingType;

/**
 * Class SecondRankingType
 * @package Ranking\RankingTypes
 */
final class SecondRankingType implements IRankingType
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'second';
    }
}