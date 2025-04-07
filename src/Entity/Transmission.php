<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TransmissionRepository::class)]
class Transmission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'transmission primaire' ne peut pas dépasser 255 caractères.")]
    private ?string $finalTransmission = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'embrayage' ne peut pas dépasser 255 caractères.")]
    private ?string $clutch = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'commande' ne peut pas dépasser 255 caractères.")]
    private ?string $command = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'boite de vitesse' ne peut pas dépasser 255 caractères.")]
    private ?string $gearbox = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\NewVehicle",
        mappedBy: "transmission",
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

    public function getFinalTransmission(): ?string
    {
        return $this->finalTransmission;
    }

    public function setFinalTransmission(?string $finalTransmission): self
    {
        $this->finalTransmission = $finalTransmission;

        return $this;
    }

    public function getClutch(): ?string
    {
        return $this->clutch;
    }

    public function setClutch(?string $clutch): self
    {
        $this->clutch = $clutch;

        return $this;
    }

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(?string $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(?string $gearbox): self
    {
        $this->gearbox = $gearbox;

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
            $newVehicle->setTransmission($this);
        }

        return $this;
    }

    public function removeNewVehicle(NewVehicle $newVehicle): self
    {
        if ($this->newVehicles->contains($newVehicle)) {
            $this->newVehicles->removeElement($newVehicle);

            if ($newVehicle->getTransmission() === $this) {
                $newVehicle->setTransmission(null);
            }
        }

        return $this;
    }
}
