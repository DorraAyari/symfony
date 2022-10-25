<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    private ?String $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    //plusieurs students vers une seule clasrroom
    private ?Classroom $Clasrroom = null;

    #[ORM\ManyToMany(targetEntity: Club::class, inversedBy: 'students')]
    #[ORM\JoinTable(name: 'students')]
    #[ORM\JoinColumn(name: 'student_id',referencedColumnName:'nsc')]
    #[ORM\InverseJoinColumn(name: 'club_id',referencedColumnName:'ref')]

    private Collection $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getnsc(): ?string
    {
        return $this->nsc;
    }
    public function setnsc(string $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getClasrroom(): ?Classroom
    {
        return $this->Clasrroom;
    }

    public function setClasrroom(?Classroom $Clasrroom): self
    {
        $this->Clasrroom = $Clasrroom;

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        $this->clubs->removeElement($club);

        return $this;
    }
}
