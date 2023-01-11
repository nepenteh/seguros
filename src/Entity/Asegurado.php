<?php

namespace App\Entity;

use App\Repository\AseguradoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AseguradoRepository::class)]
class Asegurado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombre = null;

    #[ORM\Column(length: 40)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 40)]
    private ?string $apellido2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function __toString(): string
    {
        return $this->apellido1." ".$this->apellido2.", ".$this->nombre;
    }
}
