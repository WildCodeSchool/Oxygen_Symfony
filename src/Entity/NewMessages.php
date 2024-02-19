<?php

namespace App\Entity;

use App\Repository\NewMessagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewMessagesRepository::class)]
class NewMessages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'newMessages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?student $student_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?student
    {
        return $this->student_id;
    }

    public function setStudentId(?student $student_id): static
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
