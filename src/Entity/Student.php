<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     */
    private $nsc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=ClassRoom::class, inversedBy="students")
     */
    private $classroom;

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    /**
     * @param mixed $nsc
     */
    public function setNsc($nsc): void
    {
        $this->nsc = $nsc;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?ClassRoom
    {
        return $this->classroom;
    }

    public function setClassroom(?ClassRoom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
