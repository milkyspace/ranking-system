<?php

namespace Ranking\RankingLanguages;

use Ranking\Interfaces\IRankingLanguage;

/**
 * Class EnLanguage
 * @package Ranking\RankingLanguages
 */
final class EnLanguage implements IRankingLanguage
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'en';
    }

    /**
     * @return string
     */
    public function getSqlField(): string
    {
        return 'rank_calculated_en';
    }
}