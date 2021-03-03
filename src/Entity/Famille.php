<?php
	
	namespace App\Entity;
	
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Security\Core\User\UserInterface;
	
	/**
	 * Famille
	 *
	 * @ORM\Table(name="parent", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQUE", columns={"email"})})
	 * @ORM\Entity
	 */
	class Famille implements UserInterface {
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
		 * @ORM\Column(name="nom", type="string", length=50, nullable=false)
		 */
		private $nom;
		
		/**
		 * @var string
		 *
		 * @ORM\Column(name="email", type="string", length=50, nullable=false)
		 */
		private $email;
		
		/**
		 * @var string
		 *
		 * @ORM\Column(name="password", type="string", length=50, nullable=false)
		 */
		private $password;
		
		/**
		 * @var int
		 *
		 * @ORM\Column(name="montant_mensuel", type="integer", nullable=false)
		 */
		private $montantMensuel;
		
		/**
		 * @ORM\OneToMany(targetEntity=Poulet::class, mappedBy="maFamille")
		 */
		private $pouletsAdoptes;
		
		public function __construct() {
			$this->pouletsAdoptes = new ArrayCollection();
		}
		
		public function getId(): ?int {
			return $this->id;
		}
		
		public function getPrenom(): ?string {
			return $this->prenom;
		}
		
		public function setPrenom(string $prenom): self {
			$this->prenom = $prenom;
			
			return $this;
		}
		
		public function getNom(): ?string {
			return $this->nom;
		}
		
		public function setNom(string $nom): self {
			$this->nom = $nom;
			
			return $this;
		}
		
		public function getEmail(): ?string {
			return $this->email;
		}
		
		public function setEmail(string $email): self {
			$this->email = $email;
			
			return $this;
		}
		
		public function getPassword(): ?string {
			return $this->password;
		}
		
		public function setPassword(string $password): self {
			$this->password = $password;
			
			return $this;
		}
		
		public function getMontantMensuel(): ?int {
			return $this->montantMensuel;
		}
		
		public function setMontantMensuel(int $montant): self {
			$this->montantMensuel += $montant;
			
			return $this;
		}
		
		/**
		 * @return Collection|Poulet[]
		 */
		public function getPouletsAdoptes(): Collection {
			return $this->pouletsAdoptes;
		}
		
		public function addPouletsAdopte(Poulet $pouletsAdopte): self {
			if (!$this->pouletsAdoptes->contains($pouletsAdopte)) {
				$this->pouletsAdoptes[] = $pouletsAdopte;
				$pouletsAdopte->setFamille($this);
			}
			
			return $this;
		}
		
		public function removePouletsAdopte(Poulet $pouletsAdopte): self {
			if ($this->pouletsAdoptes->removeElement($pouletsAdopte)) {
				// set the owning side to null (unless already changed)
				if ($pouletsAdopte->getFamille() === $this) {
					$pouletsAdopte->setFamille(null);
				}
			}
			
			return $this;
		}
		
		public function getRoles() {
			$roles[] = 'ROLE_USER';
			return array_unique($roles);
		}
		
		public function getSalt() {
			// TODO: Implement getSalt() method.
		}
		
		public function getUsername() {
			// TODO: Implement getUsername() method.
		}
		
		public function eraseCredentials() {
			// TODO: Implement eraseCredentials() method.
		}
	}
