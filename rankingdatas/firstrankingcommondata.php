<?php

namespace Ranking\RankingDatas;

use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectException;
use Bitrix\Main\SystemException;
use Ranking\Interfaces\IRankingCommonData;

/**
 * Class RankingCommonData
 * @package Ranking
 */
final class FirstRankingCommonData implements IRankingCommonData
{
    private $orders = [];
    private $payments = [];
    private $reviews = [];
    private $countries = [];
    private $regions = [];
    private $expertsAnswerTime = [];
    private $badReviews = [];
    private $top10Experts = [];
    private $top10Countries = [];
    private $paymentsMiddleBy14Days = 0.0;
    private $tours = [];
    private $conversionOfVisitOrder = 0;
    private $paymentsBy14Days = 0;
    private $ordersBy14Days = 0;
    private $russiaId = 0;
    private $dagestanId = 0;
    private $countriesEurope = [];
    private $experts = [];
    private $paymentsByExpertId = [];
    private $ordersByExpertId = [];
    private $toursByExpertId = [];
    private $tourMonthsBackFirstPublish = [];
    private $reviewsByExpertId = [];
    private $toursId = [];

    public function __construct($tours = [])
    {
        $this->toursId = $tours;
    }

    /**
     * @return array
     */
    public function getOrders(): ?array
    {
        return $this->orders;
    }

    /**
     * @return array
     */
    public function getPayments(): ?array
    {
        return $this->payments;
    }

    /**
     * @return array
     */
    public function getReviews(): ?array
    {
        return $this->reviews;
    }

    /**
     * @return array
     */
    public function getCountries(): ?array
    {
        return $this->countries;
    }

    /**
     * @return array
     */
    public function getRegions(): ?array
    {
        return $this->regions;
    }

    /**
     * @return array
     */
    public function getExpertsAnswerTime(): ?array
    {
        return $this->expertsAnswerTime;
    }

    /**
     * @return array
     */
    public function getBadReviews(): ?array
    {
        return $this->badReviews;
    }

    /**
     * @return array
     */
    public function getTop10Experts(): ?array
    {
        return $this->top10Experts;
    }

    /**
     * @return array
     */
    public function getTop10Countries(): ?array
    {
        return $this->top10Countries;
    }

    /**
     * @return int
     */
    public function getPaymentsMiddleBy14Days(): ?float
    {
        return (float)$this->paymentsMiddleBy14Days;
    }

    /**
     * @return array
     */
    public function getFirsts(): ?array
    {
        return $this->tours;
    }

    /**
     * @return int
     */
    public function getConversionOfVisitOrder(): ?int
    {
        return $this->conversionOfVisitOrder;
    }

    /**
     * @return int
     */
    public function getPaymentsBy14Days(): ?int
    {
        return $this->paymentsBy14Days;
    }

    /**
     * @return int
     */
    public function getOrdersBy14Days(): ?int
    {
        return $this->ordersBy14Days;
    }

    /**
     * @return int
     */
    public function getRussiaId(): ?int
    {
        return $this->russiaId;
    }

    /**
     * @return int
     */
    public function getDagestanId(): ?int
    {
        return $this->dagestanId;
    }

    /**
     * @return array
     */
    public function getCountriesEurope(): ?array
    {
        return $this->countriesEurope;
    }

    /**
     * @return array
     */
    public function getExperts(): ?array
    {
        return $this->experts;
    }

    /**
     * @return array
     */
    public function getPaymentsByExpertId(): ?array
    {
        return $this->paymentsByExpertId;
    }

    /**
     * @return array
     */
    public function getOrdersByExpertId(): ?array
    {
        return $this->ordersByExpertId;
    }

    /**
     * @return array
     */
    public function getFirstsByExpertId(): ?array
    {
        return $this->toursByExpertId;
    }

    /**
     * @return array
     */
    public function getFirstMonthsBackFirstPublish(): ?array
    {
        return $this->tourMonthsBackFirstPublish;
    }

    /**
     * @return array
     */
    public function getReviewsByExpertId(): ?array
    {
        return $this->reviewsByExpertId;
    }

    /**
     * @throws LoaderException
     * @throws ObjectException
     * @throws SystemException
     */
    public function processData(): void
    {
        // include modules

        $this->processOrders();
        // next
    }

    private function processPayments(): void
    {
        //
    }

    private function processPaymentsBy14Days(): void
    {
        //
    }

    private function processOrders(): void
    {
        //
    }

    private function processPaymentsMiddleBy14Days(): void
    {
        //
    }

    private function processReviewsAverage(): void
    {
        //
    }

    private function processBadReviewsCount(): void
    {
        //
    }

    private function processVisitToOrderConversion(): void
    {
        //
    }

    private function processRegions(): void
    {
        //
    }

    private function processCountries(): void
    {
        //
    }

    private function processTop10Countries(): void
    {
        //
    }

    private function processExperts(): void
    {
        //
    }

    private function processOrdersBy14Days(): void
    {
        //
    }

    private function processSingleCountries(): void
    {
        //
    }

    private function processFirsts(): void
    {
        //
    }
}