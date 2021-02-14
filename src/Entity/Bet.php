<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bet
 *
 * @ORM\Table(name="bet")
 * @ORM\Entity
 */
class Bet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fixture_id", type="string", length=45, nullable=true)
     */
    private $fixtureId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="market_id", type="integer", nullable=true)
     */
    private $marketId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="market_name", type="string", length=255, nullable=true)
     */
    private $marketName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="main_line", type="string", length=45, nullable=true)
     */
    private $mainLine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="outcome_id", type="bigint", nullable=true)
     */
    private $outcomeId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="outcome_name", type="string", length=255, nullable=true)
     */
    private $outcomeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="main_line_outcome", type="string", length=45, nullable=true)
     */
    private $mainLineOutcome;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line", type="string", length=45, nullable=true)
     */
    private $line;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getFixtureId(): ?string
    {
        return $this->fixtureId;
    }

    /**
     * @param string|null $fixtureId
     */
    public function setFixtureId(?string $fixtureId): void
    {
        $this->fixtureId = $fixtureId;
    }

    /**
     * @return int|null
     */
    public function getMarketId(): ?int
    {
        return $this->marketId;
    }

    /**
     * @param int|null $marketId
     */
    public function setMarketId(?int $marketId): void
    {
        $this->marketId = $marketId;
    }

    /**
     * @return string|null
     */
    public function getMarketName(): ?string
    {
        return $this->marketName;
    }

    /**
     * @param string|null $marketName
     */
    public function setMarketName(?string $marketName): void
    {
        $this->marketName = $marketName;
    }

    /**
     * @return string|null
     */
    public function getMainLine(): ?string
    {
        return $this->mainLine;
    }

    /**
     * @param string|null $mainLine
     */
    public function setMainLine(?string $mainLine): void
    {
        $this->mainLine = $mainLine;
    }

    /**
     * @return int|null
     */
    public function getOutcomeId(): ?int
    {
        return $this->outcomeId;
    }

    /**
     * @param int|null $outcomeId
     */
    public function setOutcomeId(?int $outcomeId): void
    {
        $this->outcomeId = $outcomeId;
    }

    /**
     * @return string|null
     */
    public function getOutcomeName(): ?string
    {
        return $this->outcomeName;
    }

    /**
     * @param string|null $outcomeName
     */
    public function setOutcomeName(?string $outcomeName): void
    {
        $this->outcomeName = $outcomeName;
    }

    /**
     * @return string|null
     */
    public function getMainLineOutcome(): ?string
    {
        return $this->mainLineOutcome;
    }

    /**
     * @param string|null $mainLineOutcome
     */
    public function setMainLineOutcome(?string $mainLineOutcome): void
    {
        $this->mainLineOutcome = $mainLineOutcome;
    }

    /**
     * @return string|null
     */
    public function getLine(): ?string
    {
        return $this->line;
    }

    /**
     * @param string|null $line
     */
    public function setLine(?string $line): void
    {
        $this->line = $line;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }



}
