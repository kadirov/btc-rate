<?php

namespace App\Repository;

use App\Component\Rate\Constants\CurrencyPair;
use App\Entity\Rate;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rate[]    findAll()
 * @method Rate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateRepository extends ServiceEntityRepository
{
    /**
     * RateRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return Rate|null
     * @see CurrencyPair
     */
    public function findFirstByDate(int $currencyPair): ?Rate
    {
        try {
            $result = $this->createQueryBuilder('r')
                ->orderBy('r.date', 'ASC')
                ->andWhere('r.currencyPair = :currencyPair')
                ->setParameter('currencyPair', $currencyPair)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }

        return $result;
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return Rate|null
     * @see CurrencyPair
     */
    public function findLastByDate(int $currencyPair): ?Rate
    {
        try {
            $result = $this->createQueryBuilder('r')
                ->orderBy('r.date', 'DESC')
                ->andWhere('r.currencyPair = :currencyPair')
                ->setParameter('currencyPair', $currencyPair)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }

        return $result;
    }

    /**
     * @param DateTimeInterface $dateFrom
     * @param DateTimeInterface $dateBy
     * @param int $currencyPair
     * @return Rate[]|[]
     */
    public function findBetweenDates(DateTimeInterface $dateFrom, DateTimeInterface $dateBy, int $currencyPair): array
    {
        $result = $this->createQueryBuilder('r')
            ->orderBy('r.date', 'ASC')
            ->andWhere('r.currencyPair = :currencyPair')
            ->andWhere('r.date BETWEEN :dateFrom AND :dateBy')
            ->setParameter('currencyPair', $currencyPair)
            ->setParameter('dateFrom', $dateFrom)
            ->setParameter('dateBy', $dateBy)
            ->getQuery()
            ->getResult();

        return $result;
    }
}
