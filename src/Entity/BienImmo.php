<?php

namespace App\Entity;

use App\Repository\BienImmoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BienImmoRepository::class)]
class BienImmo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $Type = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?float $Prix = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $Ville = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?float $Superficie = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?int $Pieces = null;

    #[ORM\Column(type: "datetime_immutable")]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $Annee = null;

    #[ORM\Column(type: "text")]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Photo = null;

    /**
     * @ORM\Column(length: 255, nullable: true)
     */
    private ?string $photoFilename;

    #[ORM\Column(length: 255)]
    private ?string $Youtube = null;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'Projet')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getSuperficie(): ?float
    {
        return $this->Superficie;
    }

    public function setSuperficie(float $Superficie): self
    {
        $this->Superficie = $Superficie;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->Pieces;
    }

    public function setPieces(int $Pieces): self
    {
        $this->Pieces = $Pieces;

        return $this;
    }

    public function getAnnee(): ?\DateTimeImmutable
    {
        return $this->Annee;
    }

    public function setAnnee(\DateTimeImmutable $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function setPhotoFilename(?string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->Youtube;
    }

    public function setYoutube(string $Youtube): static
    {
        $this->Youtube = $Youtube;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setProjet($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getProjet() === $this) {
                $message->setProjet(null);
            }
        }

        return $this;
    }

   
}
