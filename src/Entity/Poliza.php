<?php

namespace App\Entity;

use App\Repository\PolizaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PolizaRepository::class)]
class Poliza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $referencia = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\OneToMany(mappedBy: 'poliza', targetEntity: Averia::class)]
    private Collection $listaAverias;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aseguradora $aseguradora = null;

    #[ORM\ManyToOne]
    private ?Inmueble $inmueble = null;

    #[ORM\ManyToOne]
    private ?Asegurado $asegurado = null;

    public function __construct()
    {
        $this->listaAverias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(string $referencia): self
    {
        $this->referencia = $referencia;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Averia>
     */
    public function getListaAverias(): Collection
    {
        return $this->listaAverias;
    }

    public function addListaAveria(Averia $averia): self
    {
        if (!$this->listaAverias->contains($averia)) {
            $this->listaAverias->add($averia);
            $averia->setPoliza($this);
        }

        return $this;
    }

    public function removeListaAveria(Averia $averia): self
    {
        if ($this->listaAverias->removeElement($averia)) {
            // set the owning side to null (unless already changed)
            if ($averia->getPoliza() === $this) {
                $averia->setPoliza(null);
            }
        }

        return $this;
    }

    public function getAseguradora(): ?Aseguradora
    {
        return $this->aseguradora;
    }

    public function setAseguradora(?Aseguradora $aseguradora): self
    {
        $this->aseguradora = $aseguradora;

        return $this;
    }

    public function getInmueble(): ?Inmueble
    {
        return $this->inmueble;
    }

    public function setInmueble(?Inmueble $inmueble): self
    {
        $this->inmueble = $inmueble;

        return $this;
    }

    public function getAsegurado(): ?Asegurado
    {
        return $this->asegurado;
    }

    public function setAsegurado(?Asegurado $asegurado): self
    {
        $this->asegurado = $asegurado;

        return $this;
    }
}
