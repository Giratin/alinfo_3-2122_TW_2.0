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
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="float")
     */
    private $moyenne;

    /**
     * @ORM\ManyToOne(targetEntity=ClassRoom::class, inversedBy="students")
     */
    private $classroom;

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * @param mixed $moyenne
     */
    public function setMoyenne($moyenne): void
    {
        $this->moyenne = $moyenne;
    }


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
