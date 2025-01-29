<?php

namespace App\Entity;

use App\Repository\RetweetsRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetweetsRepository::class)]
class Retweets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Posts::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Posts $post = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct(){
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Posts
    {
        return $this->post;
    }

    public function setPost(?Posts $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}



// namespace App\Entity;

// use App\Repository\RetweetsRepository;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: RetweetsRepository::class)]
// class Retweets
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\ManyToOne]
//     #[ORM\JoinColumn(nullable: false)]
//     private ?Posts $post_id = null;

//     #[ORM\ManyToOne]
//     #[ORM\JoinColumn(nullable: false)]
//     private ?User $user_id = null;

//     #[ORM\Column]
//     private ?\DateTimeImmutable $createdAt = null;

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getPostId(): ?Posts
//     {
//         return $this->post_id;
//     }

//     public function setPostId(?Posts $post_id): static
//     {
//         $this->post_id = $post_id;

//         return $this;
//     }

//     public function getUserId(): ?User
//     {
//         return $this->user_id;
//     }

//     public function setUserId(?User $user_id): static
//     {
//         $this->user_id = $user_id;

//         return $this;
//     }

//     public function getCreatedAt(): ?\DateTimeImmutable
//     {
//         return $this->createdAt;
//     }

//     public function setCreatedAt(\DateTimeImmutable $createdAt): static
//     {
//         $this->createdAt = $createdAt;

//         return $this;
//     }
// } 
