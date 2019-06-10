<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Fake\Generator\Interfaces;

use App\Component\Rate\Interfaces\RateInterface;
use DateTimeInterface;

/**
 * Interface RateGeneratorInterface
 * @package App\Component\Rate\Provider\Btc\Fake\Generator\Interfaces
 */
interface RateGeneratorInterface
{
    /**
     * @param DateTimeInterface $from
     * @param DateTimeInterface $by
     * @return RateInterface[]
     */
    public function generateForDateRage(DateTimeInterface $from, DateTimeInterface $by): array;
}
