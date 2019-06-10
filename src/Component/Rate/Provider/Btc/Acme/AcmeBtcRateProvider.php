<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Acme;

use App\Component\Rate\Interfaces\RateInterface;
use App\Component\Rate\Provider\Interfaces\RateProviderInterface;
use DateTimeInterface;

/**
 * Class AcmeBtcRateProvider
 * @package App\Component\Rate\Provider\Btc\Acme
 */
class AcmeBtcRateProvider implements RateProviderInterface
{
    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair
     * @return RateInterface[]
     */
    public function getRates(DateTimeInterface $dateFrom, DateTimeInterface$dateBy, int $currencyPair): array
    {
        // TODO: Implement getRates() method.
    }
}
