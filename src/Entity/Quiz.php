<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Question::class, inversedBy: 'quizzes')]
    private Collection $question;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    private ?User $users = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: ResultatQuiz::class)]
    private Collection $resultatQuizzes;

    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->resultatQuizzes = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, question>
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question->add($question);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        $this->question->removeElement($question);

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
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
            $resultatQuiz->setQuiz($this);
        }

        return $this;
    }

    public function removeResultatQuiz(ResultatQuiz $resultatQuiz): self
    {
        if ($this->resultatQuizzes->removeElement($resultatQuiz)) {
            // set the owning side to null (unless already changed)
            if ($resultatQuiz->getQuiz() === $this) {
                $resultatQuiz->setQuiz(null);
            }
        }

        return $this;
    }
}
