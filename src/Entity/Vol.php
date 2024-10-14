<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "La ville de destination est obligatoire.")]
    private $villeDestination;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotBlank(message: "La date de départ est obligatoire.")]
    #[Assert\Type("\DateTimeInterface")]
    private $dateDeDepart;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotBlank(message: "La date d'arrivée est obligatoire.")]
    #[Assert\Type("\DateTimeInterface")]
    private $dateDArrivee;

    #[ORM\ManyToOne(targetEntity: Aeroport::class, inversedBy: 'vols')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "L'aéroport est obligatoire.")]
    private $aeroport;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDestination(): ?string
    {
        return $this->villeDestination;
    }

    public function setVilleDestination(string $villeDestination): self
    {
        $this->villeDestination = $villeDestination;

        return $this;
    }

    public function getDateDeDepart(): ?\DateTimeInterface
    {
        return $this->dateDeDepart;
    }

    public function setDateDeDepart(\DateTimeInterface $dateDeDepart): self
    {
        $this->dateDeDepart = $dateDeDepart;

        return $this;
    }

    public function getDateDArrivee(): ?\DateTimeInterface
    {
        return $this->dateDArrivee;
    }

    public function setDateDArrivee(\DateTimeInterface $dateDArrivee): self
    {
        $this->dateDArrivee = $dateDArrivee;

        return $this;
    }

    public function getAeroport(): ?Aeroport
    {
        return $this->aeroport;
    }

    public function setAeroport(?Aeroport $aeroport): self
    {
        $this->aeroport = $aeroport;

        return $this;
    }
}
