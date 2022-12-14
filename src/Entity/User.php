<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Role $role = null;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Quiz::class)]
    private Collection $quizzes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ResultatQuiz::class)]
    private Collection $resultatQuizzes;

    public function __construct()
    {
        $this->quizzes = new ArrayCollection();
        $this->resultatQuizzes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {

        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Quiz>
     */
    public function getQuizzes(): Collection
    {
        return $this->quizzes;
    }

    public function addQuiz(Quiz $quiz): self
    {
        if (!$this->quizzes->contains($quiz)) {
            $this->quizzes->add($quiz);
            $quiz->setUsers($this);
        }

        return $this;
    }

    public function removeQuiz(Quiz $quiz): self
    {
        if ($this->quizzes->removeElement($quiz)) {
            // set the owning side to null (unless already changed)
            if ($quiz->getUsers() === $this) {
                $quiz->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResultatQuiz>
     */
    public function getResultatQuizzes(): Collection
    {
        return $this->resultatQuizzes;
    }

    public function addResultatQuiz(ResultatQuiz $resultatQuiz): self
    {
        if (!$this->resultatQuizzes->contains($resultatQuiz)) {
            $this->resultatQuizzes->add($resultatQuiz);
            $resultatQuiz->setUser($this);
        }

        return $this;
    }

    public function removeResultatQuiz(ResultatQuiz $resultatQuiz): self
    {
        if ($this->resultatQuizzes->removeElement($resultatQuiz)) {
            // set the owning side to null (unless already changed)
            if ($resultatQuiz->getUser() === $this) {
                $resultatQuiz->setUser(null);
            }
        }

        return $this;
    }
}
