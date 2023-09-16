<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
    private $slugfr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slugen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titrefr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreen;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textefr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $texteen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlugfr(): ?string
    {
        return $this->slugfr;
    }

    public function setSlugfr(string $slugfr): self
    {
        $this->slugfr = $slugfr;

        return $this;
    }

    public function getSlugen(): ?string
    {
        return $this->slugen;
    }

    public function setSlugen(string $slugen): self
    {
        $this->slugen = $slugen;

        return $this;
    }

    public function getTitrefr(): ?string
    {
        return $this->titrefr;
    }

    public function setTitrefr(string $titrefr): self
    {
        $this->titrefr = $titrefr;

        return $this;
    }

    public function getTitreen(): ?string
    {
        return $this->titreen;
    }

    public function setTitreen(string $titreen): self
    {
        $this->titreen = $titreen;

        return $this;
    }

    public function getTextefr(): ?string
    {
        return $this->textefr;
    }

    public function setTextefr(?string $textefr): self
    {
        $this->textefr = $textefr;

        return $this;
    }

    public function getTexteen(): ?string
    {
        return $this->texteen;
    }

    public function setTexteen(?string $texteen): self
    {
        $this->texteen = $texteen;

        return $this;
    }
}
