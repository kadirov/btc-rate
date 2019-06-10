<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Interfaces;

use App\Component\Rate\Constants\CurrencyPair;
use App\Component\Rate\Interfaces\RateInterface;
use DateTimeInterface;

/**
 * Interface ProviderInterface
 * @package App\Component\Rate\Provider\Interfaces
 */
interface RateProviderInterface
{
    /**
     * @see CurrencyPair
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return RateInterface[]
     */
    public function getRates(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array;
}
