<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;




/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message= "L'email que vous avez indiqué est déjà utilisé !"
 * )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit faire 8 caractères au minimum")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tappé le même mot de passe")
     */
    public $confirm_password;
    

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ban;

    /**
     * @ORM\Column(type="boolean")
     */
    private $unsubscribe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Liste", mappedBy="users", orphanRemoval=true)
     */
    private $listes;

    public function __construct()
    {
        $this->listes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getBan(): ?bool
    {
        return $this->ban;
    }

    public function setBan(bool $ban): self
    {
        $this->ban = $ban;

        return $this;
    }

    public function getUnsubscribe(): ?bool
    {
        return $this->unsubscribe;
    }

    public function setUnsubscribe(bool $unsubscribe): self
    {
        $this->unsubscribe = $unsubscribe;

        return $this;
    }

    public function eraseCredentials(){}

    public function getSalt(){}
    


      /**
     * @ORM\column(type="json")
     */
    private $roles=[];   
    public function getRoles() : array
    {
        $roles = $this->roles;

        if($this->getAdmin()== true)
        {
            $roles[]='ROLE_ADMIN';
        }
        else{
            $roles[]='ROLE_USER';
        }

        return array_unique($roles);
        
    }

    /**
     * @return Collection|Liste[]
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Liste $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->setUsers($this);
        }

        return $this;
    }

    public function removeListe(Liste $liste): self
    {
        if ($this->listes->contains($liste)) {
            $this->listes->removeElement($liste);
            // set the owning side to null (unless already changed)
            if ($liste->getUsers() === $this) {
                $liste->setUsers(null);
            }
        }

        return $this;
    }
}
