<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/* use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; */

/* @UniqueEntity("Name") */
/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ServantRepository")
 */
class Servant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Regex("/^[a-zA-Z]/")
     * @Assert\Length(min=3, max=255)
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * 
     * @ORM\Column(type="string", length=255, options={"default": "Saber"})
     */
    private $Class;

    /**
     * @Assert\Regex("/^[a-zA-Z]/")
     * @Assert\Length(min=10, max=255)
     * @ORM\Column(type="text")
     */
    private $Noble_Phantasme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Master", inversedBy="Servant")
     */
    private $Master;

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

    public function getClass(): ?string
    {
        return $this->Class;
    }

    public function setClass(string $Class): self
    {
        $this->Class = $Class;

        return $this;
    }

    public function getNoblePhantasme(): ?string
    {
        return $this->Noble_Phantasme;
    }

    public function setNoblePhantasme(string $Noble_Phantasme): self
    {
        $this->Noble_Phantasme = $Noble_Phantasme;

        return $this;
    }

    public function getMaster(): ?Master
    {
        return $this->Master;
    }

    public function setMaster(?Master $Master): self
    {
        $this->Master = $Master;

        return $this;
    }
}
