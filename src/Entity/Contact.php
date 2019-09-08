<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * @JMS\ExclusionPolicy("ALL")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank(
     *     message="Le champ nom doit être rempli."
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre nom doit être au minimum {{ limit }} caractères",
     * )
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank(
     *     message="Le champ prénom doit être rempli."
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre prénom doit être au minimum {{ limit }} caractères",
     * )
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank(
     *     message="Le champ email doit être rempli."
     * )
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas une email valide."
     * )
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\NotBlank(
     *     message="Le champ département doit être rempli."
     * )
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $department;

    /**
     * @ORM\Column(type="text")
     * 
     * @Assert\NotBlank(
     *     message="Le champ message doit être rempli."
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre message doit être au minimum {{ limit }} caractères",
     * )
     * 
     * @JMS\Groups({"getContact"})
     * @JMS\Expose()
     * 
     */
    private $message;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
