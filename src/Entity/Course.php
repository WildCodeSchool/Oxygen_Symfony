<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 1500)]
    private ?string $description = null;

    #[ORM\Column(length: 150)]
    private ?string $capacity = null;

    #[ORM\Column(length: 100)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]
    private ?string $duration = null;

    #[ORM\Column(length: 100)]
    private ?string $degree = null;

    #[ORM\Column]
    private ?int $financing_supported = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?discipline $discipline_id = null;

    #[ORM\Column(length: 755)]
    private ?string $url_image = null;

    #[ORM\OneToMany(mappedBy: 'course_id', targetEntity: Student::class)]
    private Collection $students;

    #[ORM\OneToOne(mappedBy: 'course_id', cascade: ['persist', 'remove'])]
    private ?Applications $applications = null;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): static
    {
        $this->degree = $degree;

        return $this;
    }

    public function getFinancingSupported(): ?int
    {
        return $this->financing_supported;
    }

    public function setFinancingSupported(int $financing_supported): static
    {
        $this->financing_supported = $financing_supported;

        return $this;
    }

    public function getDisciplineId(): ?discipline
    {
        return $this->discipline_id;
    }

    public function setDisciplineId(?discipline $discipline_id): static
    {
        $this->discipline_id = $discipline_id;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->url_image;
    }

    public function setUrlImage(string $url_image): static
    {
        $this->url_image = $url_image;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setCourseId($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getCourseId() === $this) {
                $student->setCourseId(null);
            }
        }

        return $this;
    }

    public function getApplications(): ?Applications
    {
        return $this->applications;
    }

    public function setApplications(Applications $applications): static
    {
        // set the owning side of the relation if necessary
        if ($applications->getCourseId() !== $this) {
            $applications->setCourseId($this);
        }

        $this->applications = $applications;

        return $this;
    }
}
