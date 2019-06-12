<?php declare(strict_types=1);

namespace App\Component\Rate;

use App\Component\Rate\Constants\CurrencyPair;
use App\Component\Rate\Interfaces\RateInterface;
use App\Component\Rate\Interfaces\RateManagerInterface;
use App\Entity\Rate;
use App\Repository\RateRepository;
use DateTimeInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RateManager
 * @package App\Component\Rate
 */
class RateManager implements RateManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * RateManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param RateInterface $rate
     * @param bool $flush
     */
    public function save(RateInterface $rate, bool $flush = true): void
    {
        $this->em->persist($rate);

        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return RateInterface[]|[]
     * @see CurrencyPair
     */
    public function getBetween(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array
    {
        return $this->getRepository()->findBetweenDates($dateFrom, $dateBy, $currencyPair);
    }

    /**
     * This method returns last saved date
     *
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return DateTimeInterface|null
     * @see CurrencyPairget
     */
    public function getLastDate(int $currencyPair): ?DateTimeInterface
    {
        $rate = $this->getRepository()->findLastByDate($currencyPair);

        if ($rate === null) {
            return null;
        }

        return $rate->getDate();
    }

    /**
     * This method returns first saved date
     *
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return DateTimeInterface|null
     * @see CurrencyPair
     */
    public function getFirstDate(int $currencyPair): ?DateTimeInterface
    {
        $rate = $this->getRepository()->findFirstByDate($currencyPair);

        if ($rate === null) {
            return null;
        }

        return $rate->getDate();
    }

    /**
     * @return RateRepository|ObjectRepository
     */
    private function getRepository(): RateRepository
    {
        return $this->em->getRepository(Rate::class);
    }
}
