<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
* @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
* @JMS\ExclusionPolicy("ALL")
*/
class Department
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    *
    * @JMS\Groups({"getDepartments", "getDepartment"})
    * @JMS\Expose()
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=255)
    *
    * @JMS\Groups({"getDepartments", "getDepartment"})
    * @JMS\Expose()
    */
    private $name;

    /**
    * @ORM\Column(type="string", length=255)
    */
    private $email;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}