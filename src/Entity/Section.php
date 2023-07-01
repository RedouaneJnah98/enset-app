<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $semester = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $year = null;

    #[ORM\Column(length: 20)]
    private ?string $roomNo = null;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Field $field = null;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'sections')]
    private Collection $professor;

    public function __construct()
    {
        $this->professor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemester(): ?string
    {
        return $this->semester;
    }

    public function setSemester(string $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRoomNo(): ?string
    {
        return $this->roomNo;
    }

    public function setRoomNo(string $roomNo): self
    {
        $this->roomNo = $roomNo;

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProfessor(): Collection
    {
        return $this->professor;
    }

    public function addProfessor(User $professor): self
    {
        if (!$this->professor->contains($professor)) {
            $this->professor->add($professor);
            $professor->addSection($this);
        }

        return $this;
    }

    public function removeProfessor(User $professor): self
    {
        $this->professor->removeElement($professor);

        return $this;
    }
}
