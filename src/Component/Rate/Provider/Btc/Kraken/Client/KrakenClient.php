<?php declare(strict_types=1);

namespace App\Component\Rate\Provider\Btc\Kraken\Client;

use App\Component\Rate\Constants\CurrencyPair;
use App\Component\Rate\Interfaces\RateFactoryInterface;
use App\Component\Rate\Provider\Btc\Kraken\Client\Dto\KrakenResponse;
use App\Component\Rate\Provider\Btc\Kraken\Client\Interfaces\KrakenClientInterface;
use App\Entity\Rate;
use Curl\Curl;
use DateTime;
use DateTimeInterface;
use Exception;
use LogicException;
use Throwable;

/**
 * Class KrakenClient
 * @package App\Component\Rate\Provider\Btc\Kraken\Client
 */
class KrakenClient implements KrakenClientInterface
{
    /**
     * Kraken API URL
     */
    private const URL = 'https://api.kraken.com/0/public/OHLC';

    /**
     * Interval of rates
     */
    private const INTERVAL_OF_RATES = 60;

    /**
     * @var RateFactoryInterface
     */
    private $rateFactory;

    /**
     * KrakenClient constructor.
     * @param RateFactoryInterface $rateFactory
     */
    public function __construct(
        RateFactoryInterface $rateFactory
    ) {
        $this->rateFactory = $rateFactory;
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @param DateTimeInterface $since
     * @return Rate[]|[]
     * @see CurrencyPair
     */
    public function getSince(int $currencyPair, DateTimeInterface $since): array
    {
        $json = $this->doRequest($currencyPair, $this->minusOneHour($since));

        if ($json === null) {
            return [];
        }

        $response = new KrakenResponse($this->rateFactory);
        $response->createFromJson($json, $currencyPair);

        return $response->getRates();
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @param DateTimeInterface $since
     * @return string
     * @see CurrencyPair
     */
    private function doRequest(int $currencyPair, DateTimeInterface $since): ?string
    {
        try {
            $curl = new Curl();
        } catch (Throwable $exception) {
            return null;
        }

        $curl->get(self::URL, [
            'pair' => $this->getPair($currencyPair),
            'interval' => self::INTERVAL_OF_RATES,
            'since' => $since->getTimestamp(),
        ]);

        if ($curl->error) {
            return null;
        }

        return $curl->response;
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return string
     * @see CurrencyPair
     */
    private function getPair(int $currencyPair): string
    {
        switch ($currencyPair) {
            case CurrencyPair::BTC_USD:
                return 'XBTUSD';

            case CurrencyPair::BTC_EUR:
                return 'XBTEUR';

            default:
                throw new LogicException('Wrong current ' . $currencyPair);
        }
    }

    /**
     * @param DateTimeInterface $since
     * @return DateTimeInterface
     */
    private function minusOneHour(DateTimeInterface $since): DateTimeInterface
    {
        try {
            $date = new DateTime();
            $date->setTimestamp($since->getTimestamp());
            $date->modify('-1 hour');
            return $date;
        } catch (Exception $exception) {
            return $since;
        }
    }
}
