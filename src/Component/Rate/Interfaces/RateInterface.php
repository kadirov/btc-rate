<?php declare(strict_types=1);

namespace App\Component\Rate\Interfaces;

use DateTimeInterface;

/**
 * Interface RateInterface
 * @package App\Component\Rate\Interfaces
 */
interface RateInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return float
     */
    public function getHigh(): float;

    /**
     * @return float
     */
    public function getOpen(): float;

    /**
     * @return float
     */
    public function getLow(): float;

    /**
     * @return float
     */
    public function getClose(): float;

    /**
     * @return int
     */
    public function getCurrencyPair(): int;

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface;
}
