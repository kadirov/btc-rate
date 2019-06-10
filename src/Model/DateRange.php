<?php declare(strict_types=1);

namespace App\Model;

use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DateRange
 * @package App\Model
 */
class DateRange
{
    /**
     * @var DateTimeInterface
     *
     * @Assert\NotBlank()
     */
    private $dateFrom;

    /**
     * @var DateTimeInterface
     *
     * @Assert\Type("\DateTime")
     * @Assert\NotBlank()
     */
    private $dateBy;

    /**
     * DateRange constructor.
     */
    public function __construct()
    {
        $this->dateFrom = new DateTime();
        $this->dateBy = new DateTime();
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateFrom(): ?DateTimeInterface
    {
        return $this->dateFrom;
    }

    /**
     * @param DateTimeInterface $dateFrom
     */
    public function setDateFrom(DateTimeInterface $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateBy(): ?DateTimeInterface
    {
        return $this->dateBy;
    }

    /**
     * @param DateTimeInterface $dateBy
     */
    public function setDateBy(DateTimeInterface $dateBy): void
    {
        $this->dateBy = $dateBy;
    }
}
