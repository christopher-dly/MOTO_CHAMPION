<?php 

namespace App\Entity;

use App\Repository\UsedVehicleImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsedVehicleImageRepository::class)]
class UsedVehicleImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(
        targetEntity: UsedVehicle::class,
        inversedBy: "usedVehicleImages",
        cascade: ["persist", "remove"]
    )]
    #[ORM\JoinColumn(nullable: false)]
    private ?UsedVehicle $usedVehicle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getUsedVehicle(): ?UsedVehicle
    {
        return $this->usedVehicle;
    }

    public function setUsedVehicle(?UsedVehicle $usedVehicle): self
    {
        $this->usedVehicle = $usedVehicle;
        return $this;
    }
}