<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken;

use App\Component\Rate\Interfaces\RateInterface;
use App\Component\Rate\Interfaces\RateManagerInterface;
use App\Component\Rate\Provider\Btc\Kraken\Interfaces\KrakenUpdaterInterface;
use App\Component\Rate\Provider\Interfaces\RateProviderInterface;
use DateTimeInterface;

/**
 * Class AcmeBtcRateProvider
 * @package App\Component\Rate\Provider\Btc\Acme
 */
class KrakenBtcRateProvider implements RateProviderInterface
{
    /**
     * @var KrakenUpdaterInterface
     */
    private $updater;
    /**
     * @var RateManagerInterface
     */
    private $rateManager;

    /**
     * KrakenBtcRateProvider constructor.
     * @param KrakenUpdaterInterface $updater
     * @param RateManagerInterface $rateManager
     */
    public function __construct(
        KrakenUpdaterInterface $updater,
        RateManagerInterface $rateManager
    ) {
        $this->updater = $updater;
        $this->rateManager = $rateManager;
    }

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair
     * @return RateInterface[]
     */
    public function getRates(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array
    {
        $this->updater->updateIfNeed($dateFrom, $dateBy, $currencyPair);

        return $this->rateManager->getBetween($dateFrom, $dateBy, $currencyPair);
    }
}
