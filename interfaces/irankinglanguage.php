<?php

namespace Ranking\Interfaces;

/**
 * Interface IRankingLanguage
 * @package Ranking\Interfaces
 */
interface IRankingLanguage
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return string
     */
    public function getSqlField(): string;
}