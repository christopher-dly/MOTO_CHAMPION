<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CyclepartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CyclepartRepository::class)]
class CyclePart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $casterAngle = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $caster = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $wheelbase = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'jantes' ne peut pas dépasser 255 caractères.")]
    private ?string $rim = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'cadre' ne peut pas dépasser 255 caractères.")]
    private ?string $frame = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'suspension avant' ne peut pas dépasser 255 caractères.")]
    private ?string $frontSuspension = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'suspension arrière' ne peut pas dépasser 255 caractères.")]
    private ?string $rearSuspension = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'freins avant' ne peut pas dépasser 255 caractères.")]
    private ?string $frontBrake = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'freins arrière' ne peut pas dépasser 255 caractères.")]
    private ?string $rearBrake = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'roues avant' ne peut pas dépasser 255 caractères.")]
    private ?string $frontWheel = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "Le champ pour 'roues arrière' ne peut pas dépasser 255 caractères.")]
    private ?string $rearWheel = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\NewVehicle",
        mappedBy: "cyclePart",
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

    public function getCasterAngle(): ?float
    {
        return $this->casterAngle;
    }

    public function setCasterAngle(?float $casterAngle): self
    {
        $this->casterAngle = $casterAngle;

        return $this;
    }

    public function getCaster(): ?float
    {
        return $this->caster;
    }

    public function setCaster(?float $caster): self
    {
        $this->caster = $caster;

        return $this;
    }

    public function getWheelbase(): ?float
    {
        return $this->wheelbase;
    }

    public function setWheelbase(?float $wheelbase): self
    {
        $this->wheelbase = $wheelbase;

        return $this;
    }

    public function getRim(): ?string
    {
        return $this->rim;
    }

    public function setRim(?string $rim): self
    {
        $this->rim = $rim;

        return $this;
    }

    public function getFrame(): ?string
    {
        return $this->frame;
    }

    public function setFrame(?string $frame): self
    {
        $this->frame = $frame;

        return $this;
    }

    public function getFrontSuspension(): ?string
    {
        return $this->frontSuspension;
    }

    public function setFrontSuspension(?string $frontSuspension): self
    {
        $this->frontSuspension = $frontSuspension;

        return $this;
    }

    public function getRearSuspension(): ?string
    {
        return $this->rearSuspension;
    }

    public function setRearSuspension(?string $rearSuspension): self
    {
        $this->rearSuspension = $rearSuspension;

        return $this;
    }

    public function getFrontBrake(): ?string
    {
        return $this->frontBrake;
    }

    public function setFrontBrake(?string $frontBrake): self
    {
        $this->frontBrake = $frontBrake;

        return $this;
    }

    public function getRearBrake(): ?string
    {
        return $this->rearBrake;
    }

    public function setRearBrake(?string $rearBrake): self
    {
        $this->rearBrake = $rearBrake;

        return $this;
    }

    public function getFrontWheel(): ?string
    {
        return $this->frontWheel;
    }

    public function setFrontWheel(?string $frontWheel): self
    {
        $this->frontWheel = $frontWheel;

        return $this;
    }

    public function getRearWheel(): ?string
    {
        return $this->rearWheel;
    }

    public function setRearWheel(?string $rearWheel): self
    {
        $this->rearWheel = $rearWheel;

        return $this;
    }

    public function getNewVehicles(): Collection
    {
        return $this->newVehicles;
    }

    public function addNewVehicle(NewVehicle $newVehicle): self
    {
        if (!$this->newVehicles->contains($newVehicle)) {
            $this->newVehicles->add($newVehicle);
            $newVehicle->setCyclePart($this);
        }

        return $this;
    }

    public function removeNewVehicle(NewVehicle $newVehicle): self
    {
        if ($this->newVehicles->contains($newVehicle)) {
            $this->newVehicles->removeElement($newVehicle);
            // Unset the owning side relationship
            if ($newVehicle->getCyclePart() === $this) {
                $newVehicle->setCyclePart(null);
            }
        }

        return $this;
    }
}
