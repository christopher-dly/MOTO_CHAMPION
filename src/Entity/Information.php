<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InformationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InformationRepository::class)]
class Information
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "La marque est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "La marque ne doit pas dépasser 50 caractères.")]
    private ?string $brand = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "Le modèle est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "Le modèle ne doit pas dépasser 50 caractères.")]
    private ?string $model = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "La catégorie est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "La catégorie ne doit pas dépasser 50 caractères.")]
    private ?string $category = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "Le nombre de cylindres est obligatoire.")]
    private ?int $cylinders = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "Le prix est obligatoire.")]
    #[Assert\GreaterThanOrEqual(0, message: "Le prix ne peut pas être négatif.")]
    private ?float $price = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "Le temps de garantie est obligatoire.")]
    #[Assert\GreaterThanOrEqual(0, message: "Le temps de garantie ne peut pas être négatif.")]
    private ?int $warrantyTime = 5;

    #[ORM\Column(type: 'boolean')]
    private ?bool $availableForTrial = false;

    #[ORM\Column(type: 'json')]
    private ?array $license = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\NewVehicle",
        mappedBy: "information",
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWarrantyTime(): ?int
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(?int $warrantyTime): self
    {
        $this->warrantyTime = $warrantyTime;

        return $this;
    }

    public function getAvailableForTrial(): ?bool
    {
        return $this->availableForTrial;
    }

    public function setAvailableForTrial(?bool $availableForTrial): self
    {
        $this->availableForTrial = $availableForTrial;

        return $this;
    }

    public function getLicense(): ?array
    {
        return $this->license;
    }

    public function setLicense(?array $license): self
    {
        $this->license = $license;

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
            $newVehicle->setInformation($this);
        }

        return $this;
    }

    public function removeNewVehicle(NewVehicle $newVehicle): self
    {
        if ($this->newVehicles->removeElement($newVehicle)) {
            if ($newVehicle->getInformation() === $this) {
                $newVehicle->setInformation(null);
            }
        }

        return $this;
    }
}
