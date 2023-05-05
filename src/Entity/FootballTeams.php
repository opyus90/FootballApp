<?php

namespace App\Entity;

use App\Repository\FootballTeamsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FootballTeamsRepository::class)
 */
class FootballTeams
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $money_balance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $players;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMoneyBalance(): ?string
    {
        return $this->money_balance;
    }

    public function setMoneyBalance(?string $money_balance): self
    {
        $this->money_balance = $money_balance;

        return $this;
    }

    public function getPlayers(): ?string
    {
        return $this->players;
    }

    public function setPlayers(?string $players): self
    {
        $this->players = $players;

        return $this;
    }
}
