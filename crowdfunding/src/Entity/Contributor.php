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
     * @ORM\JoinColumn(name="users", referencedColumnName="id")
     */
    private $users;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles" ,inversedBy="contributor")
     * @ORM\JoinColumn(name="articles", referencedColumnName="id")
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

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles): void
    {
        $this->articles = $articles;
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
