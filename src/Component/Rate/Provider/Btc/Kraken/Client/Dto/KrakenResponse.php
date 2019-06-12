<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken\Client\Dto;

use App\Component\Rate\Interfaces\RateFactoryInterface;
use App\Entity\Rate;
use DateTime;
use Throwable;
use function is_array;

/**
 * Class KrakenResponse
 * @package App\Component\Rate\Provider\Btc\Kraken\Client\Dto
 */
class KrakenResponse
{
    /**
     * @var array
     */
    private $error = [];

    /**
     * @var RateFactoryInterface
     */
    private $rateFactory;

    /**
     * @var int
     */
    private $currencyPair;

    /**
     * @var object
     */
    private $obj;

    /**
     * @var Rate[]|[]
     */
    private $rates = [];

    /**
     * KrakenResponse constructor.
     * @param RateFactoryInterface $rateFactory
     */
    public function __construct(
        RateFactoryInterface $rateFactory
    ) {
        $this->rateFactory = $rateFactory;
    }

    /**
     * @param string $krakenResponse
     * @param int $currencyPair
     */
    public function createFromJson(string $krakenResponse, int $currencyPair): void
    {
        $this->obj = json_decode($krakenResponse);

        $this->error = $this->obj->error ?? [];
        $this->currencyPair = $currencyPair;

        $this->parseUsd();
        $this->parseEur();
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->error);
    }

    /**
     * @return Rate[]|[]
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    /**
     * Parse BTC/USD pair
     */
    private function parseUsd(): void
    {
        $this->parseCurrency('XXBTZUSD');
    }

    /**
     * Parse BTC/EUR pair
     */
    private function parseEur(): void
    {
        $this->parseCurrency('XXBTZEUR');
    }

    /**
     * @param string $currency
     */
    private function parseCurrency(string $currency): void
    {
        if (!isset($this->obj->result->$currency) || !is_array($this->obj->result->$currency)) {
            return;
        }

        foreach ($this->obj->result->$currency as $array) {
            // todo We have to figure out what to do if has no all data
            if (!isset($array[0], $array[1], $array[2], $array[3], $array[4])) {
                continue;
            }

            try {
                $date = new DateTime();
                $date->setTimestamp((integer)$array[0]);
            } catch (Throwable $exception) {
                continue;
            }

            $this->rates[] = $this->rateFactory->createWithData(
                (float)$array[1],
                (float)$array[2],
                (float)$array[3],
                (float)$array[4],
                $date,
                $this->currencyPair
            );
        }
    }
}
