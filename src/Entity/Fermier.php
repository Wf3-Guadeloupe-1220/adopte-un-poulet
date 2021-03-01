<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fermier
 *
 * @ORM\Table(name="fermier", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQUE", columns={"email"})})
 * @ORM\Entity
 */
class Fermier
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Poulet::class, mappedBy="fermier")
     */
    private $poulets;

    public function __construct()
    {
        $this->poulets = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Poulet[]
     */
    public function getPoulets(): Collection
    {
        return $this->poulets;
    }

    public function addPoulet(Poulet $poulet): self
    {
        if (!$this->poulets->contains($poulet)) {
            $this->poulets[] = $poulet;
            $poulet->setMonFermier($this);
        }

        return $this;
    }

    public function removePoulet(Poulet $poulet): self
    {
        if ($this->poulets->removeElement($poulet)) {
            // set the owning side to null (unless already changed)
            if ($poulet->getMonFermier() === $this) {
                $poulet->setMonFermier(null);
            }
        }

        return $this;
    }


}
