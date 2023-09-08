<?php

// src/Entity/Assist.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssistRepository")
 * @ORM\Table(name="assist")
 */
class Assist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="The question cannot be blank.")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="The question should not exceed {{ limit }} characters."
     * )
     */
    private $question;

    /**
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="The reponse cannot be blank.")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="The reponse should not exceed {{ limit }} characters."
     * )
     */
    private $reponse;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="The dateAssist cannot be blank.")
     */
    private $dateAssist;

    // Getter and setter methods as in your original code

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getDateAssist(): ?\DateTimeInterface
    {
        return $this->dateAssist;
    }

    public function setDateAssist(\DateTimeInterface $dateAssist): self
    {
        $this->dateAssist = $dateAssist;

        return $this;
    }
}
