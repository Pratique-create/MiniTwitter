<?php



namespace App\Entity;

use App\Repository\PostsRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="posts")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=Retweet::class, mappedBy="posts")
     */
    private $retweets;

    public function __construct(){
        $this->createdAt = new DateTimeImmutable();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user_id): static
    {
        $this->user = $user_id;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

// namespace App\Entity;

// use App\Repository\PostsRepository;
// use DateTimeImmutable;
// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;

// #[ORM\Entity(repositoryClass: PostsRepository::class)]
// class Posts
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 255)]
//     private ?string $content = null;

//     #[ORM\ManyToOne]
//     #[ORM\JoinColumn(nullable: false)]
//     private ?User $user = null;

//     #[ORM\Column]
//     private ?\DateTimeImmutable $createdAt = null;

//     public function __construct(){
//         $this->createdAt = new DateTimeImmutable();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getContent(): ?string
//     {
//         return $this->content;
//     }

//     public function setContent(string $content): static
//     {
//         $this->content = $content;

//         return $this;
//     }

//     public function getUser(): ?User
//     {
//         return $this->user;
//     }

//     public function setUser(?User $user): static
//     {
//         $this->user = $user;

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
