<?php declare(strict_types=1);

namespace App\Model\Dto;

use App\Component\Rate\Interfaces\RateInterface;
use DateTimeInterface;

/**
 * Class Rate
 * @package App\Model\Dto
 */
class Rate implements RateInterface
{
    /**
     * @var float
     */
    private $rate;

    /**
     * @var DateTimeInterface
     */
    private $time;

    /**
     * Rate constructor.
     * @param float $rate
     * @param DateTimeInterface $time
     */
    public function __construct(float $rate, DateTimeInterface $time)
    {
        $this->rate = $rate;
        $this->time = $time;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface
    {
        return $this->time;
    }
}
