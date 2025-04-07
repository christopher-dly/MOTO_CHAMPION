<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $sender = null;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $object = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $phone = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(
        targetEntity: MessageImage::class,
        mappedBy: "message",
        cascade: ["persist", "remove"]
    )]
    private Collection $messageImages;

    public function __construct()
    {
        $this->messageImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(?string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(?string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMessageImages(): Collection
    {
        return $this->messageImages;
    }

    public function addMessageImage(MessageImage $messageImage): self
    {
        if (!$this->messageImages->contains($messageImage)) {
            $this->messageImages[] = $messageImage;
            $messageImage->setMessage($this);
        }

        return $this;
    }

    public function removeMessageImage(MessageImage $messageImage): self
    {
        if ($this->messageImages->contains($messageImage)) {
            $this->messageImages->removeElement($messageImage);

            if ($messageImage->getMessage() === $this) {
                $messageImage->setMessage(null);
            }
        }

        return $this;
    }
}