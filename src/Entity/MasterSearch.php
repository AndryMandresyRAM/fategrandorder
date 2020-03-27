<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


class MasterSearch
{
    private $name;

    private $magictype;

    /**
     * Get the value of magictype
     */
    public function getMagictype(): ?string
    {
        return $this->magictype;
    }

    /**
     * Set the value of magictype
     *
     * @return  self
     */
    public function setMagictype(string $magictype): MasterSearch
    {
        $this->magictype = $magictype;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): MasterSearch
    {
        $this->name = $name;

        return $this;
    }
}
