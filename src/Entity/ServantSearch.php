<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints As Assert;

class ServantSearch{
    
    
    private $name;


    private $classe;

    

    /**
     * Get the value of classe
     * @Assert\Range(min=0, max=6)
     */ 
    public function getClasse(): ?int
    {
        return $this->classe;
    }

    /**
     * Set the value of classe
     *
     * @return  self
     */ 
    public function setClasse(int $classe): ServantSearch
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name): ServantSearch
    {
        $this->name = $name;

        return $this;
    }
}