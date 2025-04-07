<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DimensionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DimensionRepository::class)]
class Dimension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $length = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $width = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $height = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $saddleHeight = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $groundClearance = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $gas = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $oil = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $weight = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\NewVehicle",
        mappedBy: "dimension",
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

    public function getSaddleHeight(): ?int
    {
        return $this->saddleHeight;
    }

    public function setSaddleHeight(?int $saddleHeight): self
    {
        $this->saddleHeight = $saddleHeight;

        return $this;
    }

    public function getGroundClearance(): ?int
    {
        return $this->groundClearance;
    }

    public function setGroundClearance(?int $groundClearance): self
    {
        $this->groundClearance = $groundClearance;

        return $this;
    }

    public function getGas(): ?int
    {
        return $this->gas;
    }

    public function setGas(?int $gas): self
    {
        $this->gas = $gas;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getOil(): ?int
    {
        return $this->oil;
    }

    public function setOil(?int $oil): self
    {
        $this->oil = $oil;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

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
            $newVehicle->setDimension($this);
        }

        return $this;
    }

    public function removeNewVehicle(NewVehicle $newVehicle): self
    {
        if ($this->newVehicles->removeElement($newVehicle)) {
            if ($newVehicle->getDimension() === $this) {
                $newVehicle->setDimension(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return "Dimensions: {$this->length}x{$this->width}x{$this->height}";
    }
}
