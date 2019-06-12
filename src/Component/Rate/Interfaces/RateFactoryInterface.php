<?php declare(strict_types=1);

namespace App\Component\Rate\Interfaces;

use DateTimeInterface;

/**
 * Interface RateFactoryInterface
 * @package App\Component\Rate\Interfaces
 */
interface RateFactoryInterface
{
    /**
     * @param float $open
     * @param float $high
     * @param float $low
     * @param float $close
     * @param int $currencyPair
     * @param DateTimeInterface $date
     * @return RateInterface
     */
    public function createWithData(
        float $open,
        float $high,
        float $low,
        float $close,
        DateTimeInterface $date,
        int $currencyPair
    ): RateInterface;
}
