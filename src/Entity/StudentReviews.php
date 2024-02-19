<?php

namespace App\Entity;

use App\Repository\StudentReviewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentReviewsRepository::class)]
class StudentReviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?student $student_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $testimonial = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?student
    {
        return $this->student_id;
    }

    public function setStudentId(student $student_id): static
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getTestimonial(): ?string
    {
        return $this->testimonial;
    }

    public function setTestimonial(string $testimonial): static
    {
        $this->testimonial = $testimonial;

        return $this;
    }
}
