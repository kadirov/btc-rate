<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Fake;

use App\Component\Rate\Interfaces\RateInterface;
use App\Component\Rate\Provider\Btc\Fake\Generator\Interfaces\RateGeneratorInterface;
use App\Component\Rate\Provider\Interfaces\RateProviderInterface;
use DateTimeInterface;

/**
 * Class FakeBtcRateProvider
 * @package App\Component\Rate\Provider\Btc\Fake
 */
class FakeBtcRateProvider implements RateProviderInterface
{
    /**
     * @var RateGeneratorInterface
     */
    private $generator;

    /**
     * FakeBtcRateProvider constructor.
     * @param RateGeneratorInterface $generator
     */
    public function __construct(RateGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair
     * @return RateInterface[]
     */
    public function getRates(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array
    {
        return $this->generator->generateForDateRage($dateFrom, $dateBy);
    }
}
