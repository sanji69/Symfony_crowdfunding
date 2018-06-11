<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContributorRepository")
 */
class Contributor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Users",inversedBy="contributor")
     * @ORM\JoinColumn(nullable=false , unique=false)
     */
    private $users;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles" ,inversedBy="contributor")
     * @ORM\JoinColumn(nullable=false , unique=false)
     */
    private $articles;


    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="datetime")
     */
    private $submit_at;

    public function getId()
    {
        return $this->id;
    }

    public function getUsers(): ?int
    {
        return $this->users;
    }

    public function setUsers(int $users_id): self
    {
        $this->users_id = $users_id;

        return $this;
    }

    public function getArticles(): ?int
    {
        return $this->articles;
    }

    public function setArticles(int $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getSubmitAt(): ?\DateTimeInterface
    {
        return $this->submit_at;
    }

    public function setSubmitAt(\DateTimeInterface $submit_at): self
    {
        $this->submit_at = $submit_at;

        return $this;
    }
}
