<?php

namespace App\Entity;

use App\Component\Rate\Constants\CurrencyPair;
use App\Component\Rate\Interfaces\RateInterface;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RateRepository")
 */
class Rate implements RateInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $high;

    /**
     * @ORM\Column(type="float")
     */
    private $open;

    /**
     * @ORM\Column(type="float")
     */
    private $low;

    /**
     * @ORM\Column(type="float")
     */
    private $close;

    /**
     * @ORM\Column(type="integer")
     */
    private $currencyPair;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getHigh(): float
    {
        return $this->high;
    }

    /**
     * @param float $high
     * @return Rate
     */
    public function setHigh(float $high): self
    {
        $this->high = $high;

        return $this;
    }

    /**
     * @return float
     */
    public function getOpen(): float
    {
        return $this->open;
    }

    /**
     * @param float $open
     * @return Rate
     */
    public function setOpen(float $open): self
    {
        $this->open = $open;

        return $this;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     * @return Rate
     */
    public function setLow(float $low): self
    {
        $this->low = $low;

        return $this;
    }

    /**
     * @return float
     */
    public function getClose(): float
    {
        return $this->close;
    }

    /**
     * @param float $close
     * @return Rate
     */
    public function setClose(float $close): self
    {
        $this->close = $close;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrencyPair(): int
    {
        return $this->currencyPair;
    }

    /**
     * @param int $currencyPair A constant of {@see CurrencyPair}
     * @return Rate
     * @see CurrencyPair
     */
    public function setCurrencyPair(int $currencyPair): self
    {
        $this->currencyPair = $currencyPair;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     * @return Rate
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
