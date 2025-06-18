<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsedVehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsedVehicleRepository::class)]
class UsedVehicle
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
    #[Assert\Length(max: 50, maxMessage: "La catégorie ne doit pas dépasser 50 caractères.")]
    private ?string $category = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "Le nombre de cylindres doit être un entier positif.")]
    private ?int $cylinders = null;

    #[ORM\Column(type: 'float')]
    #[Assert\GreaterThanOrEqual(0, message: "Le prix ne peut pas être négatif.")]
    private ?float $price = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "Le temps de garantie ne peut pas être négatif.")]
    private ?int $warrantyTime = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $availableForTrial = false;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\Length(max: 50, maxMessage: "La couleur ne doit pas dépasser 50 caractères.")]
    private ?string $color = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "L'année ne peut pas être négative.")]
    private ?int $year = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "Le nombre de kilomètres ne peut pas être négatif.")]
    private ?int $kilometers = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "Le taux d'énergie ne peut pas être négatif.")]
    private ?int $energyTax = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(0, message: "Le taux de puissance ne peut pas être négatif.")]
    private ?int $taxPower = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\Length(max: 100, maxMessage: "La puissance ne doit pas dépasser 100 caractères.")]
    private ?string $power = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $statue = true;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $selled = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $a2 = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $soldAt = null;

    #[ORM\OneToMany(
        targetEntity: UsedVehicleImage::class,
        mappedBy: "usedVehicle",
        cascade: ["persist", "remove"]
    )]
    private Collection $usedVehicleImages;

    public function __construct()
    {
        $this->usedVehicleImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCylinders(): ?int
    {
        return $this->cylinders;
    }

    public function setCylinders(int $cylinders): self
    {
        $this->cylinders = $cylinders;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWarrantyTime(): ?int
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(int $warrantyTime): self
    {
        $this->warrantyTime = $warrantyTime;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isAvailableForTrial(): ?bool
    {
        return $this->availableForTrial;
    }

    public function setAvailableForTrial(bool $availableForTrial): self
    {
        $this->availableForTrial = $availableForTrial;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getEnergyTax(): ?int
    {
        return $this->energyTax;
    }

    public function setEnergyTax(int $energyTax): self
    {
        $this->energyTax = $energyTax;

        return $this;
    }

    public function getTaxPower(): ?int
    {
        return $this->taxPower;
    }

    public function setTaxPower(int $taxPower): self
    {
        $this->taxPower = $taxPower;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(string $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function isStatue(): ?bool
    {
        return $this->statue;
    }

    public function setStatue(bool $statue): self
    {
        $this->statue = $statue;

        return $this;
    }

    public function isA2(): ?bool
    {
        return $this->a2;
    }

    public function setA2(bool $a2): self
    {
        $this->a2 = $a2;

        return $this;
    }

    public function isSelled(): ?bool
    {
        return $this->selled;
    }

    public function setSelled(bool $selled): self
    {
        $this->selled = $selled;

        return $this;
    }

    public function getUsedVehicleImages(): Collection
    {
        return $this->usedVehicleImages;
    }

    public function getSoldAt(): ?\DateTimeInterface
    {
        return $this->soldAt;
    }

    public function setSoldAt(?\DateTimeInterface $soldAt): self
    {
        $this->soldAt = $soldAt;
        return $this;
    }

    public function addUsedVehicleImage(UsedVehicleImage $usedVehicleImage): self
    {
        if (!$this->usedVehicleImages->contains($usedVehicleImage)) {
            $this->usedVehicleImages[] = $usedVehicleImage;
            $usedVehicleImage->setUsedVehicle($this);
        }

        return $this;
    }

    public function removeUsedVehicleImage(UsedVehicleImage $usedVehicleImage): self
    {
        if ($this->usedVehicleImages->contains($usedVehicleImage)) {
            $this->usedVehicleImages->removeElement($usedVehicleImage);

            if ($usedVehicleImage->getUsedVehicle() === $this) {
                $usedVehicleImage->setUsedVehicle(null);
            }
        }

        return $this;
    }
}
