<?php

namespace App\Service;

use App\Entity\TemporaryMessage;
use Doctrine\ORM\EntityManagerInterface;

class TemporaryMessageService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getMessage(): ?string
    {
        $temporaryMessage = $this->em->getRepository(TemporaryMessage::class)->findOneBy([]);
        return $temporaryMessage ? $temporaryMessage->getMessage() : null;
    }
}
