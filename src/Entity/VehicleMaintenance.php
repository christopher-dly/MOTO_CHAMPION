<?php

namespace App\Entity;

use App\Repository\VehicleMaintenanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleMaintenanceRepository::class)]
class VehicleMaintenance 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $brand;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $model;

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $year;

    #[ORM\ManyToOne(
        targetEntity: VehicleMaintenanceLittle::class,
        inversedBy: "vehicleMaintenance",
        cascade: ["persist", "remove"]
    )]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?VehicleMaintenanceLittle $vehicleMaintenanceLittle = null;
    
    #[ORM\ManyToOne(
        targetEntity: VehicleMaintenanceMedium::class,
        inversedBy: "vehicleMaintenance",
        cascade: ["persist", "remove"]
        )]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?VehicleMaintenanceMedium $vehicleMaintenanceMedium = null;
        
    #[ORM\ManyToOne(
        targetEntity: VehicleMaintenanceLarge::class,
        inversedBy: "vehicleMaintenance",
        cascade: ["persist", "remove"]
    )]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?VehicleMaintenanceLarge $vehicleMaintenanceLarge = null;

    #[ORM\ManyToOne(
        targetEntity: VehicleMaintenanceXLarge::class,
        inversedBy: "vehicleMaintenance",
        cascade: ["persist", "remove"]
    )]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?VehicleMaintenanceXLarge $vehicleMaintenanceXLarge = null;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getVehicleMaintenanceLittle(): ?VehicleMaintenanceLittle
    {
        return $this->vehicleMaintenanceLittle;
    }

    public function setVehicleMaintenanceLittle(?VehicleMaintenanceLittle $vehicleMaintenanceLittle): self
    {
        $this->vehicleMaintenanceLittle = $vehicleMaintenanceLittle;
        return $this;
    }

    public function getVehicleMaintenanceMedium(): ?VehicleMaintenanceMedium
    {
        return $this->vehicleMaintenanceMedium;
    }

    public function setVehicleMaintenanceMedium(?VehicleMaintenanceMedium $vehicleMaintenanceMedium): self
    {
        $this->vehicleMaintenanceMedium = $vehicleMaintenanceMedium;
        return $this;
    }

    public function getVehicleMaintenanceLarge(): ?VehicleMaintenanceLarge
    {
        return $this->vehicleMaintenanceLarge;
    }

    public function setVehicleMaintenanceLarge(?VehicleMaintenanceLarge $vehicleMaintenanceLarge): self
    {
        $this->vehicleMaintenanceLarge = $vehicleMaintenanceLarge;
        return $this;
    }

    public function getVehicleMaintenanceXLarge(): ?VehicleMaintenanceXLarge
    {
        return $this->vehicleMaintenanceXLarge;
    }

    public function setVehicleMaintenanceXLarge(?VehicleMaintenanceXLarge $vehicleMaintenanceXLarge): self
    {
        $this->vehicleMaintenanceXLarge = $vehicleMaintenanceXLarge;
        return $this;
    }
}
