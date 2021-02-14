<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fixture
 *
 * @ORM\Table(name="fixture")
 * @ORM\Entity
 */
class Fixture
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
     * @var int|null
     *
     * @ORM\Column(name="fixture_id", type="integer", nullable=true)
     */
    private $fixtureId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sport_id", type="integer", nullable=true)
     */
    private $sportId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sport_label", type="string", length=255, nullable=true)
     */
    private $sportLabel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="location_id", type="integer", nullable=true)
     */
    private $locationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="location_label", type="string", length=255, nullable=true)
     */
    private $locationLabel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="league_id", type="integer", nullable=true)
     */
    private $leagueId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="league_label", type="string", length=255, nullable=true)
     */
    private $leagueLabel;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="home_team_id", type="integer", nullable=true)
     */
    private $homeTeamId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="home_team_label", type="string", length=255, nullable=true)
     */
    private $homeTeamLabel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="away_team_id", type="string", length=45, nullable=true)
     */
    private $awayTeamId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="away_team_label", type="string", length=255, nullable=true)
     */
    private $awayTeamLabel;

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
     * @return int|null
     */
    public function getFixtureId(): ?int
    {
        return $this->fixtureId;
    }

    /**
     * @param int|null $fixtureId
     */
    public function setFixtureId(?int $fixtureId): void
    {
        $this->fixtureId = $fixtureId;
    }

    /**
     * @return int|null
     */
    public function getSportId(): ?int
    {
        return $this->sportId;
    }

    /**
     * @param int|null $sportId
     */
    public function setSportId(?int $sportId): void
    {
        $this->sportId = $sportId;
    }

    /**
     * @return string|null
     */
    public function getSportLabel(): ?string
    {
        return $this->sportLabel;
    }

    /**
     * @param string|null $sportLabel
     */
    public function setSportLabel(?string $sportLabel): void
    {
        $this->sportLabel = $sportLabel;
    }

    /**
     * @return int|null
     */
    public function getLocationId(): ?int
    {
        return $this->locationId;
    }

    /**
     * @param int|null $locationId
     */
    public function setLocationId(?int $locationId): void
    {
        $this->locationId = $locationId;
    }

    /**
     * @return string|null
     */
    public function getLocationLabel(): ?string
    {
        return $this->locationLabel;
    }

    /**
     * @param string|null $locationLabel
     */
    public function setLocationLabel(?string $locationLabel): void
    {
        $this->locationLabel = $locationLabel;
    }

    /**
     * @return int|null
     */
    public function getLeagueId(): ?int
    {
        return $this->leagueId;
    }

    /**
     * @param int|null $leagueId
     */
    public function setLeagueId(?int $leagueId): void
    {
        $this->leagueId = $leagueId;
    }

    /**
     * @return string|null
     */
    public function getLeagueLabel(): ?string
    {
        return $this->leagueLabel;
    }

    /**
     * @param string|null $leagueLabel
     */
    public function setLeagueLabel(?string $leagueLabel): void
    {
        $this->leagueLabel = $leagueLabel;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime|null $startDate
     */
    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return int|null
     */
    public function getHomeTeamId(): ?int
    {
        return $this->homeTeamId;
    }

    /**
     * @param int|null $homeTeamId
     */
    public function setHomeTeamId(?int $homeTeamId): void
    {
        $this->homeTeamId = $homeTeamId;
    }

    /**
     * @return string|null
     */
    public function getHomeTeamLabel(): ?string
    {
        return $this->homeTeamLabel;
    }

    /**
     * @param string|null $homeTeamLabel
     */
    public function setHomeTeamLabel(?string $homeTeamLabel): void
    {
        $this->homeTeamLabel = $homeTeamLabel;
    }

    /**
     * @return string|null
     */
    public function getAwayTeamId(): ?string
    {
        return $this->awayTeamId;
    }

    /**
     * @param string|null $awayTeamId
     */
    public function setAwayTeamId(?string $awayTeamId): void
    {
        $this->awayTeamId = $awayTeamId;
    }

    /**
     * @return string|null
     */
    public function getAwayTeamLabel(): ?string
    {
        return $this->awayTeamLabel;
    }

    /**
     * @param string|null $awayTeamLabel
     */
    public function setAwayTeamLabel(?string $awayTeamLabel): void
    {
        $this->awayTeamLabel = $awayTeamLabel;
    }




}
