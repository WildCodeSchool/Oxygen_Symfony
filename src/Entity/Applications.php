<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationsRepository::class)]
class Applications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    private ?student $student_id = null;

    #[ORM\OneToOne(inversedBy: 'applications', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?course $course_id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

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

    public function getCourseId(): ?course
    {
        return $this->course_id;
    }

    public function setCourseId(course $course_id): static
    {
        $this->course_id = $course_id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
