<?php declare(strict_types=1);

namespace App\Component\Rate;

use App\Component\Rate\Interfaces\RateFactoryInterface;
use App\Component\Rate\Interfaces\RateInterface;
use App\Entity\Rate;
use DateTimeInterface;

/**
 * Class RateFactory
 * @package App\Component\Rate
 */
class RateFactory implements RateFactoryInterface
{
    /**
     * @param float $high
     * @param float $open
     * @param float $low
     * @param float $close
     * @param int $currencyPair
     * @param DateTimeInterface $date
     * @return RateInterface
     */
    public function createWithData(
        float $open,
        float $high,
        float $low,
        float $close,
        DateTimeInterface $date,
        int $currencyPair
    ): RateInterface {
        $rate = new Rate();
        $rate->setOpen($open);
        $rate->setHigh($high);
        $rate->setLow($low);
        $rate->setClose($close);
        $rate->setDate($date);
        $rate->setCurrencyPair($currencyPair);

        return $rate;
    }
}
