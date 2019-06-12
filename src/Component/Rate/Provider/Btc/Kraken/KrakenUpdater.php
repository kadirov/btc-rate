<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken;

use App\Component\Rate\Interfaces\RateManagerInterface;
use App\Component\Rate\Provider\Btc\Kraken\Client\Interfaces\KrakenClientInterface;
use App\Component\Rate\Provider\Btc\Kraken\Interfaces\KrakenUpdaterInterface;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

/**
 * Class KrakenUpdater
 * @package App\Component\Rate\Provider\Btc\Kraken
 */
class KrakenUpdater implements KrakenUpdaterInterface
{
    /**
     * @var RateManagerInterface
     */
    private $rateManager;

    /**
     * @var KrakenClientInterface
     */
    private $client;

    /**
     * @var DateTimeInterface
     */
    private $firstDateInDatabase;

    /**
     * @var DateTimeInterface
     */
    private $lastDateInDatabase;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * KrakenUpdater constructor.
     * @param EntityManagerInterface $entityManager
     * @param RateManagerInterface $rateManager
     * @param KrakenClientInterface $client
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RateManagerInterface $rateManager,
        KrakenClientInterface $client
    ) {
        $this->rateManager = $rateManager;
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    /**
     * Update rates if is need
     *
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @throws Exception
     * @see CurrencyPair
     */
    public function updateIfNeed(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): void
    {
        $this->clearData();

        if (!$this->isNeedToUpdate($dateFrom, $dateBy, $currencyPair)) {
            return;
        }

        foreach ($this->client->getSince($currencyPair, $dateFrom) as $rate) {
            if ($rate->getDate() < $this->firstDateInDatabase || $rate->getDate() > $this->lastDateInDatabase) {
                $this->rateManager->save($rate, false);
            }
        }

        $this->entityManager->flush();
    }

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return bool
     * @see CurrencyPair
     */
    private function isNeedToUpdate(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): bool
    {
        $this->firstDateInDatabase = $this->rateManager->getFirstDate($currencyPair);
        $this->lastDateInDatabase = $this->rateManager->getLastDate($currencyPair);

        if ($this->firstDateInDatabase === null) {
            return true;
        }

        if ($dateFrom < $this->firstDateInDatabase) {
            return true;
        }

        if ($this->lastDateInDatabase === null) {
            return true;
        }

        if ($dateBy > $this->lastDateInDatabase) {
            return true;
        }

        return false;
    }

    /**
     * Clear Data
     */
    private function clearData(): void
    {
        $this->firstDateInDatabase = null;
        $this->lastDateInDatabase = null;
    }
}
