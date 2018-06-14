<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $actived;


    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="articles")
     * @ORM\JoinColumn(name="users", referencedColumnName="id")
     */
    private $user;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Contributor", mappedBy="articles")
     * @ORM\JoinColumn(nullable=false , unique=false)
     */
    private $contributor;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {

        // de base a 0
        if (empty($status))
        {
            $this->status = 0;
        }
        else
        {
            $this->status = $status;
        }

        return $this;
    }

    public function getActived(): ?int
    {
        return $this->actived;
    }

    public function setActived(int $actived): self
    {
        // de base a 0
        if (empty($actived))
        {
            $this->actived = 0;
        }
        else
        {
            $this->actived = $actived;
        }

        return $this;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->user;
    }

    public function setUsersId(?Users $users): self
    {
        $this->user = $users;

        return $this;
    }
}
