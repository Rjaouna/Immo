<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $VilleAppartement = null;

    #[ORM\Column]
    private ?string $Superficie = null;

    #[ORM\Column]
    private ?string $Chambres = null;

    #[ORM\Column]
    private ?string $SalleBain = null;

    #[ORM\Column]
    private ?bool $Balcon = null;

    #[ORM\Column]
    private ?bool $Terrasse = null;

    #[ORM\Column]
    private ?bool $Ascenseur = null;

    #[ORM\Column]
    private ?bool $Piscine = null;

    #[ORM\Column]
    private ?bool $Parking = null;

    #[ORM\Column]
    private ?bool $Garage = null;

    #[ORM\Column(length: 255)]
    private ?string $Prix = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getVilleAppartement(): ?string
    {
        return $this->VilleAppartement;
    }

    public function setVilleAppartement(string $VilleAppartement): static
    {
        $this->VilleAppartement = $VilleAppartement;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->Superficie;
    }

    public function setSuperficie(string $Superficie): static
    {
        $this->Superficie = $Superficie;

        return $this;
    }

    public function getChambres(): ?string
    {
        return $this->Chambres;
    }

    public function setChambres(string $Chambres): static
    {
        $this->Chambres = $Chambres;

        return $this;
    }

    public function getSalleBain(): ?string
    {
        return $this->SalleBain;
    }

    public function setSalleBain(string $SalleBain): static
    {
        $this->SalleBain = $SalleBain;

        return $this;
    }

    public function isBalcon(): ?bool
    {
        return $this->Balcon;
    }

    public function setBalcon(bool $Balcon): static
    {
        $this->Balcon = $Balcon;

        return $this;
    }

    public function isTerrasse(): ?bool
    {
        return $this->Terrasse;
    }

    public function setTerrasse(bool $Terrasse): static
    {
        $this->Terrasse = $Terrasse;

        return $this;
    }

    public function isAscenseur(): ?bool
    {
        return $this->Ascenseur;
    }

    public function setAscenseur(bool $Ascenseur): static
    {
        $this->Ascenseur = $Ascenseur;

        return $this;
    }

    public function isPiscine(): ?bool
    {
        return $this->Piscine;
    }

    public function setPiscine(bool $Piscine): static
    {
        $this->Piscine = $Piscine;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->Parking;
    }

    public function setParking(bool $Parking): static
    {
        $this->Parking = $Parking;

        return $this;
    }

    public function isGarage(): ?bool
    {
        return $this->Garage;
    }

    public function setGarage(bool $Garage): static
    {
        $this->Garage = $Garage;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(?string $Message): static
    {
        $this->Message = $Message;

        return $this;
    }
}
