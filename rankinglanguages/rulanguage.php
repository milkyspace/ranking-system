<?php

namespace Ranking\RankingLanguages;

use Ranking\Interfaces\IRankingLanguage;

/**
 * Class RuLanguage
 * @package Ranking\RankingLanguages
 */
final class RuLanguage implements IRankingLanguage
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'ru';
    }

    /**
     * @return string
     */
    public function getSqlField(): string
    {
        return 'rank_calculated';
    }
}