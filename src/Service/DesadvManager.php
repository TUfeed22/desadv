<?php

namespace App\Service;

use App\Dto\DesadvXmlDto;
use App\Entity\Desadv;
use Doctrine\ORM\EntityManagerInterface;

class DesadvManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function create(DesadvXmlDto $dto): Desadv
    {
        $desadv = new Desadv();
        $desadv
            ->setNumber($dto->number)
            ->setDate($dto->date)
            ->setRecipient($dto->recipient)
            ->setSender($dto->sender)
            ->setBody($dto->body);

        return $desadv;
    }

    public function save(Desadv $desadv): int
    {
        $this->entityManager->persist($desadv);
        $this->entityManager->flush();
        return $desadv->getId();
    }
}