<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?course $course_id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $degree = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar_image = null;

    #[ORM\Column(length: 100)]
    private ?string $formation = null;

    #[ORM\OneToMany(mappedBy: 'student_id', targetEntity: NewMessages::class)]
    private Collection $newMessages;

    #[ORM\OneToMany(mappedBy: 'student_id', targetEntity: Applications::class)]
    private Collection $applications;

    public function __construct()
    {
        $this->newMessages = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseId(): ?course
    {
        return $this->course_id;
    }

    public function setCourseId(?course $course_id): static
    {
        $this->course_id = $course_id;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getAvatarImage(): ?string
    {
        return $this->avatar_image;
    }

    public function setAvatarImage(string $avatar_image): static
    {
        $this->avatar_image = $avatar_image;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, NewMessages>
     */
    public function getNewMessages(): Collection
    {
        return $this->newMessages;
    }

    public function addNewMessage(NewMessages $newMessage): static
    {
        if (!$this->newMessages->contains($newMessage)) {
            $this->newMessages->add($newMessage);
            $newMessage->setStudentId($this);
        }

        return $this;
    }

    public function removeNewMessage(NewMessages $newMessage): static
    {
        if ($this->newMessages->removeElement($newMessage)) {
            // set the owning side to null (unless already changed)
            if ($newMessage->getStudentId() === $this) {
                $newMessage->setStudentId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Applications>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Applications $application): static
    {
        if (!$this->applications->contains($application)) {
            $this->applications->add($application);
            $application->setStudentId($this);
        }

        return $this;
    }

    public function removeApplication(Applications $application): static
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getStudentId() === $this) {
                $application->setStudentId(null);
            }
        }

        return $this;
    }
}
