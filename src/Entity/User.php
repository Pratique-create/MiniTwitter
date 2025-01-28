<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use libphonenumber\PhoneNumber;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    public const ROLE_ADMIN = "ROLE_ADMIN";
    public const ROLE_USER = "ROLE_USER";
    


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // #[ORM\Column(nullable: true, type:'phone_number')]
    // private ?string $number = null;

    #[ORM\Column(type: 'phone_number', nullable: true)]
    #[AssertPhoneNumber]
    private ?PhoneNumber $number = null;

    // /**
    //  * @ORM\Column(type="phone_number", nullable=true)
    //  * @AssertPhoneNumber
    //  * @Serializer\Type("libphonenumber\PhoneNumber")
    //  *
    //  * @var PhoneNumber
    //  */
    // private $number;


    #[ORM\Column(length: 25)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $profilePicture = 'images/profil.png';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumber(): ?PhoneNumber
    {
        return $this->number;
    }

    public function setNumber(?PhoneNumber $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }


    public function getUserIdentifier(): string
    {
        return (string) $this->email; 
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];  
    }


    public function eraseCredentials(): void
    {
    }
}

