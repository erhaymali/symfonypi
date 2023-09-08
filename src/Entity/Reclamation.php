<?php
// src/Entity/Reclamation.php
// src/Entity/Reclamation.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReclamationRepository")
 * @ORM\Table(name="reclamation")
 */
class Reclamation
{
    // ...
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $utilisateurId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistId;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="The date cannot be blank.")
     */
    private $dateRec;

    /**
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="The sujet cannot be blank.")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="The sujet should not exceed {{ limit }} characters."
     * )
     */
    private $sujet;

    /**
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="The contenu cannot be blank.")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="The contenu should not exceed {{ limit }} characters."
     * )
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="The etat cannot be blank.")
     * @Assert\Length(
     *     max=50,
     *     maxMessage="The etat should not exceed {{ limit }} characters."
     * )
     */
    private $etat;

    /**
     * @return mixed
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    /**
     * @param mixed $utilisateurId
     */
    public function setUtilisateurId($utilisateurId): void
    {
        $this->utilisateurId = $utilisateurId;
    }

    /**
     * @return mixed
     */
    public function getAssistId()
    {
        return $this->assistId;
    }

    /**
     * @param mixed $assistId
     */
    public function setAssistId($assistId): void
    {
        $this->assistId = $assistId;
    }

    /**
     * @return mixed
     */
    public function getDateRec()
    {
        return $this->dateRec;
    }

    /**
     * @param mixed $dateRec
     */
    public function setDateRec($dateRec): void
    {
        $this->dateRec = $dateRec;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet): void
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    // Add getters and setters for other properties

    // ...


}
