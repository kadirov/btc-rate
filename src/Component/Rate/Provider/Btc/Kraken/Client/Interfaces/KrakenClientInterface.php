<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken\Client\Interfaces;

use App\Entity\Rate;
use DateTimeInterface;

interface KrakenClientInterface
{
    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @param DateTimeInterface $since
     * @return Rate[]|[]
     * @see CurrencyPair
     */
    public function getSince(int $currencyPair, DateTimeInterface $since): array;
}
