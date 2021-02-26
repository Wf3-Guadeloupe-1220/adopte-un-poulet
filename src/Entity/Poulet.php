<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poulet
 *
 * @ORM\Table(name="poulet", indexes={@ORM\Index(name="fk_fermier_id", columns={"id_fermier"}), @ORM\Index(name="fk_parent_id", columns={"id_parent"})})
 * @ORM\Entity(repositoryClass="App\Repository\PouletRepository")
 */
class Poulet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=30, nullable=false)
     */
    private $race;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=40, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=50, nullable=false)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \Fermier
     *
     * @ORM\ManyToOne(targetEntity="Fermier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fermier", referencedColumnName="id")
     * })
     */
    private $idFermier;

    /**
     * @var \Parent
     *
     * @ORM\ManyToOne(targetEntity="Famille")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdFermier(): ?Fermier
    {
        return $this->idFermier;
    }

    public function setIdFermier(?Fermier $idFermier): self
    {
        $this->idFermier = $idFermier;

        return $this;
    }

    public function getIdParent(): ?Famille
    {
        return $this->idParent;
    }

    public function setIdParent(?Famille $idParent): self
    {
        $this->idParent = $idParent;

        return $this;
    }


}