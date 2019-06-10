<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Fake\Generator;

use App\Component\Rate\Interfaces\RateInterface;
use App\Component\Rate\Provider\Btc\Fake\Generator\Interfaces\RateGeneratorInterface;
use App\Model\Dto\Rate;
use DateInterval;
use DateTime;
use DateTimeInterface;
use Exception;

/**
 * Class SimpleRateGenerator
 * @package App\Component\Rate\Provider\Btc\Fake\Generator
 */
class SimpleRateGenerator implements RateGeneratorInterface
{
    /**
     * Start
     */
    private const START_VALUE = 7000;

    /**
     * @var int
     */
    private $oldRate = self::START_VALUE;

    /**
     * @param DateTimeInterface $from
     * @param DateTimeInterface $by
     * @return RateInterface[]
     * @throws Exception
     */
    public function generateForDateRage(DateTimeInterface $from, DateTimeInterface $by): array
    {
        $result = [];

        $date = new DateTime($from->format('Y-m-d'));
        $endDate = new DateTime($by->format('Y-m-d 23:59:59'));
        $i = 0;

        while (true) {
            $result[] = $this->generateForDate($date);

            $date->add(new DateInterval('PT1H'));

            if ($date >= $endDate) {
                break;
            }

            $i++;

            if ($i === 1000) {
                break;
            }
        }

        return $result;
    }

    /**
     * @param DateTimeInterface $date
     * @return RateInterface
     */
    private function generateForDate(DateTimeInterface $date): RateInterface
    {
        $rate = $this->oldRate + $this->rand(-200, 200);
        $this->oldRate = (float)$rate;

        return new Rate($this->oldRate, clone $date);
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    private function rand(int $min, int $max): int
    {
        try {
            $value = random_int($min, $max);
        } catch (Exception $e) {
            $value = 0;
        }

        return $value;
    }
}
