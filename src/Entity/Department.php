<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[UniqueEntity('name')]
class Department
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 10)]
    private ?string $building = null;

    #[ORM\ManyToOne(inversedBy: 'departments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $headDepartment = null;

    #[ORM\OneToMany(mappedBy: 'department', targetEntity: Course::class)]
    private Collection $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getHeadDepartment(): ?User
    {
        return $this->headDepartment;
    }

    public function setHeadDepartment(?User $headDepartment): self
    {
        $this->headDepartment = $headDepartment;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->setDepartment($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getDepartment() === $this) {
                $course->setDepartment(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
