<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

        /**
         * @ORM\Column(type="text")
         */
    private $content;

        /**
         * @ORM\Column(type="string")
         */
    private $published;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(): void
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(): void
    {
        $this->content = $content;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished(): void
    {
        $this->published = $published;
    }
}
