<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MasterRepository")
 */
class Master
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MagicType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servant", mappedBy="Master")
     */
    private $Servant;

    public function __construct()
    {
        $this->Servant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMagicType(): ?string
    {
        return $this->MagicType;
    }

    public function setMagicType(string $MagicType): self
    {
        $this->MagicType = $MagicType;

        return $this;
    }

    /**
     * @return Collection|Servant[]
     */
    public function getServant(): Collection
    {
        return $this->Servant;
    }

    public function addServant(Servant $servant): self
    {
        if (!$this->Servant->contains($servant)) {
            $this->Servant[] = $servant;
            $servant->setMaster($this);
        }

        return $this;
    }

    public function removeServant(Servant $servant): self
    {
        if ($this->Servant->contains($servant)) {
            $this->Servant->removeElement($servant);
            // set the owning side to null (unless already changed)
            if ($servant->getMaster() === $this) {
                $servant->setMaster(null);
            }
        }

        return $this;
    }
}
