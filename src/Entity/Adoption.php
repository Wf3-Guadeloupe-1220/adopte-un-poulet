<?php

namespace App\Entity;

use App\Repository\AdoptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdoptionRepository::class)
 */
class Adoption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantMensuel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Poulet::class, inversedBy="adoption", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $poulet;

    /**
     * @ORM\ManyToOne(targetEntity=Famille::class, inversedBy="adoptionList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $famille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantMensuel(): ?float
    {
        return $this->montantMensuel;
    }

    public function setMontantMensuel(float $montantMensuel): self
    {
        $this->montantMensuel = $montantMensuel;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPoulet(): ?Poulet
    {
        return $this->poulet;
    }

    public function setPoulet(Poulet $poulet): self
    {
        $this->poulet = $poulet;

        return $this;
    }

    public function getFamille(): ?Famille
    {
        return $this->famille;
    }

    public function setFamille(?Famille $famille): self
    {
        $this->famille = $famille;

        return $this;
    }
}
