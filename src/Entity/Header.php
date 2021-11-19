<?php

namespace App\Entity;

use App\Repository\HeaderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeaderRepository::class)
 */
class Header
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btn_button;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btn_url;

    public function getId(): ?int
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

    public function getBtnButton(): ?string
    {
        return $this->btn_button;
    }

    public function setBtnButton(string $btn_button): self
    {
        $this->btn_button = $btn_button;

        return $this;
    }

    public function getBtnUrl(): ?string
    {
        return $this->btn_url;
    }

    public function setBtnUrl(string $btn_url): self
    {
        $this->btn_url = $btn_url;

        return $this;
    }
}
