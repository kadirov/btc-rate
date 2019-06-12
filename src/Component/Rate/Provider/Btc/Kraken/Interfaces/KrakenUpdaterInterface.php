<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken\Interfaces;

use App\Component\Rate\Constants\CurrencyPair;
use DateTimeInterface;

/**
 * Interface KrakenUpdaterInterface
 * @package App\Component\Rate\Provider\Btc\Kraken\Interfaces
 */
interface KrakenUpdaterInterface
{
    /**
     * Update rates if is need
     *
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @see CurrencyPair
     */
    public function updateIfNeed(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): void;
}
