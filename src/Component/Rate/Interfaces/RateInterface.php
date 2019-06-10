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
     * @return float
     */
    public function getRate(): float;

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface;
}
