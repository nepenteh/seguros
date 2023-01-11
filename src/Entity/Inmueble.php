<?php

namespace App\Entity;

use App\Repository\InmuebleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InmuebleRepository::class)]
class Inmueble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $calle = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $localidad = null;

    #[ORM\Column(length: 255)]
    private ?string $provincia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function __toString(): string
    {
        return $this->calle.
            ($this->cp ? " CP ".$this->cp : "").
            " ".$this->localidad." (".$this->provincia.") ";
    }
}
