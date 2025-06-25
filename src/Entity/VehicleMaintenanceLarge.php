<?php

namespace App\Entity;

use App\Repository\VehicleMaintenanceLargeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleMaintenanceLargeRepository::class)]
class VehicleMaintenanceLarge 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $oilFilter = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $strainerCleaning = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $airFilter = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $sparkPlug = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $variatorBelt = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $transmissionBelt = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $pebble = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $engineOilChange = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $transmissionOilChange = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $clutchOilChange = false;
    
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $price;

    #[ORM\OneToMany(
        targetEntity: VehicleMaintenance::class,
        mappedBy: "newVehicle",
        cascade: ["persist", "remove"]
    )]
    private Collection $vehicleMaintenance;

    public function __construct()
    {
        $this->vehicleMaintenance = new ArrayCollection();
    }

    public function getVehicleMaintenance(): Collection
    {
        return $this->vehicleMaintenance;
    }

    public function addVehicleMaintenance(VehicleMaintenance $vehicleMaintenance): self
    {
        if (!$this->vehicleMaintenance->contains($vehicleMaintenance)) {
            $this->vehicleMaintenance[] = $vehicleMaintenance;
            $vehicleMaintenance->setVehicleMaintenanceLarge($this);
        }

        return $this;
    }

    public function removeVehicleMaintenance(VehicleMaintenance $vehicleMaintenance): self
    {
        if ($this->vehicleMaintenance->contains($vehicleMaintenance)) {
            $this->vehicleMaintenance->removeElement($vehicleMaintenance);

            if ($vehicleMaintenance->getVehicleMaintenanceLarge() === $this) {
                $vehicleMaintenance->setVehicleMaintenanceLarge(null);
            }
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOilFilter(): ?bool
    {
        return $this->oilFilter;
    }

    public function setOilFilter(?bool $oilFilter): self
    {
        $this->oilFilter = $oilFilter;
        return $this;
    }

    public function getStrainerCleaning(): ?bool
    {
        return $this->strainerCleaning;
    }

    public function setStrainerCleaning(?bool $strainerCleaning): self
    {
        $this->strainerCleaning = $strainerCleaning;
        return $this;
    }

    public function getAirFilter(): ?bool
    {
        return $this->airFilter;
    }

    public function setAirFilter(?bool $airFilter): self
    {
        $this->airFilter = $airFilter;
        return $this;
    }

    public function getSparkPlug(): ?bool
    {
        return $this->sparkPlug;
    }

    public function setSparkPlug(?bool $sparkPlug): self
    {
        $this->sparkPlug = $sparkPlug;
        return $this;
    }

    public function getVariatorBelt(): ?bool
    {
        return $this->variatorBelt;
    }

    public function setVariatorBelt(?bool $variatorBelt): self
    {
        $this->variatorBelt = $variatorBelt;
        return $this;
    }

    public function getTransmissionBelt(): ?bool
    {
        return $this->transmissionBelt;
    }

    public function setTransmissionBelt(?bool $transmissionBelt): self
    {
        $this->transmissionBelt = $transmissionBelt;
        return $this;
    }

    public function getPebble(): ?bool
    {
        return $this->pebble;
    }  

    public function setPebble(?bool $pebble): self
    {
        $this->pebble = $pebble;
        return $this;
    }

    public function getEngineOilChange(): ?bool
    {
        return $this->engineOilChange;
    }

    public function setEngineOilChange(?bool $engineOilChange): self
    {
        $this->engineOilChange = $engineOilChange;
        return $this;
    }

    public function getTransmissionOilChange(): ?bool
    {
        return $this->transmissionOilChange;
    }

    public function setTransmissionOilChange(?bool $transmissionOilChange): self
    {
        $this->transmissionOilChange = $transmissionOilChange;
        return $this;
    }

    public function getClutchOilChange(): ?bool
    {
        return $this->clutchOilChange;
    }

    public function setClutchOilChange(?bool $clutchOilChange): self
    {
        $this->clutchOilChange = $clutchOilChange;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;
        return $this;
    }
}
