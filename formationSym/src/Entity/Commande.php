<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Assert\NotBlank(message="nom produit doit etre non vide")
     * @Assert\Length(
     *     min = 5,
     *     minMessage = "Entrer un nom au min de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="descirption doit etre non vide")
     * @Assert\Length(
     *     min = 10,
     *     max= 150,
     *     minMessage = "doit etre > 10",
     *     maxMessage = "doit etre a 150")
     * @ORM\Column(type="string", length=255)
     */
    private $description;




    /**
     * @Assert\NotBlank(message="quantite doit etre non vide")
     * @Assert\Range(
     *     min = 1,
     *     max = 9999999999,
     *     notInRangeMessage="quantite doit etre >0"
     *     )
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateC;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(\DateTimeInterface $dateC): self
    {
        $this->dateC = $dateC;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }



}
