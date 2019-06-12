<?php declare(strict_types=1);

namespace App\Component\Rate\Interfaces;

use DateTimeInterface;

/**
 * Interface RateManagerInterface
 * @package App\Component\Rate\Interfaces
 */
interface RateManagerInterface
{
    /**
     * @param RateInterface $manager
     * @param bool $flush
     */
    public function save(RateInterface $manager, bool $flush = true): void;

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return RateInterface[]|[]
     * @see CurrencyPair
     */
    public function getBetween(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array;

    /**
     * This method returns last saved date
     *
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return DateTimeInterface|null
     * @see CurrencyPair
     */
    public function getLastDate(int $currencyPair): ?DateTimeInterface;

    /**
     * This method returns first saved date
     *
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return DateTimeInterface|null
     * @see CurrencyPair
     */
    public function getFirstDate(int $currencyPair): ?DateTimeInterface;
}
