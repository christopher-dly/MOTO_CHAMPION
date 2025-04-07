<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EngineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EngineRepository::class)]
class Engine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'type' ne peut pas dépasser 255 caractères.")]
    private ?string $type = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive(message: "Le nombre de cylindres doit être un entier positif.")]
    private ?int $cylinders = null;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    #[Assert\Length(max: 150, maxMessage: "Le champ pour 'puissance annoncée' ne peut pas dépasser 150 caractères.")]
    private ?string $announcedPower = null;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    #[Assert\Length(max: 150, maxMessage: "Le champ pour 'couple annoncé' ne peut pas dépasser 150 caractères.")]
    private ?string $coupleAnnounced = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100, maxMessage: "Le champ pour 'alimentation' ne peut pas dépasser 100 caractères.")]
    private ?string $powerSupply = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100, maxMessage: "Le champ pour 'consommation' ne peut pas dépasser 100 caractères.")]
    private ?string $consumption = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100, maxMessage: "Le champ pour 'émissions de CO2' ne peut pas dépasser 100 caractères.")]
    private ?string $co2Emissions = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\NewVehicle",
        mappedBy: "engine",
        cascade: ["persist", "remove"]
    )]
    private Collection $newVehicles;

    public function __construct()
    {
        $this->newVehicles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCylinders(): ?int
    {
        return $this->cylinders;
    }

    public function setCylinders(?int $cylinders): self
    {
        $this->cylinders = $cylinders;

        return $this;
    }

    public function getAnnouncedPower(): ?string
    {
        return $this->announcedPower;
    }

    public function setAnnouncedPower(?string $announcedPower): self
    {
        $this->announcedPower = $announcedPower;

        return $this;
    }

    public function getCoupleAnnounced(): ?string
    {
        return $this->coupleAnnounced;
    }

    public function setCoupleAnnounced(?string $coupleAnnounced): self
    {
        $this->coupleAnnounced = $coupleAnnounced;

        return $this;
    }

    public function getPowerSupply(): ?string
    {
        return $this->powerSupply;
    }

    public function setPowerSupply(?string $powerSupply): self
    {
        $this->powerSupply = $powerSupply;

        return $this;
    }

    public function getConsumption(): ?string
    {
        return $this->consumption;
    }

    public function setConsumption(?string $consumption): self
    {
        $this->consumption = $consumption;

        return $this;
    }

    public function getCo2Emissions(): ?string
    {
        return $this->co2Emissions;
    }

    public function setCo2Emissions(?string $co2Emissions): self
    {
        $this->co2Emissions = $co2Emissions;

        return $this;
    }

    public function getNewVehicles(): Collection
    {
        return $this->newVehicles;
    }

    public function addNewVehicle(NewVehicle $newVehicle): self
    {
        if (!$this->newVehicles->contains($newVehicle)) {
            $this->newVehicles[] = $newVehicle;
            $newVehicle->setEngine($this);
        }

        return $this;
    }

    public function removeNewVehicle(NewVehicle $newVehicle): self
    {
        if ($this->newVehicles->contains($newVehicle)) {
            $this->newVehicles->removeElement($newVehicle);
            if ($newVehicle->getEngine() === $this) {
                $newVehicle->setEngine(null);
            }
        }

        return $this;
    }
}
