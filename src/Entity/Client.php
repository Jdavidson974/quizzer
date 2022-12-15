<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: ResultatQuiz::class)]
    private Collection $resultat;

    public function __construct()
    {
        $this->resultat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, ResultatQuiz>
     */
    public function getResultat(): Collection
    {
        return $this->resultat;
    }

    public function addResultat(ResultatQuiz $resultat): self
    {
        if (!$this->resultat->contains($resultat)) {
            $this->resultat->add($resultat);
            $resultat->setClient($this);
        }

        return $this;
    }

    public function removeResultat(ResultatQuiz $resultat): self
    {
        if ($this->resultat->removeElement($resultat)) {
            // set the owning side to null (unless already changed)
            if ($resultat->getClient() === $this) {
                $resultat->setClient(null);
            }
        }

        return $this;
    }
}
