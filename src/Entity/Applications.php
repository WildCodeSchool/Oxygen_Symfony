<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationsRepository::class)]
class Applications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'applications', targetEntity: student::class)]
    private Collection $student;

    #[ORM\OneToOne(inversedBy: 'applications', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?course $course = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, student>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(student $student): static
    {
        if (!$this->student->contains($student)) {
            $this->student->add($student);
            $student->setApplications($this);
        }

        return $this;
    }

    public function removeStudent(student $student): static
    {
        if ($this->student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getApplications() === $this) {
                $student->setApplications(null);
            }
        }

        return $this;
    }

    public function getCourse(): ?course
    {
        return $this->course;
    }

    public function setCourse(course $course): static
    {
        $this->course = $course;

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
