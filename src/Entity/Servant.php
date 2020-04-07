<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
/* use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; */

/* @UniqueEntity("Name") */
/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ServantRepository")
 * @Vich\Uploadable
 */
class Servant
{
    const CLASSE = [
       0 => 'Archer',
       1 => 'Assassin',
       2 => 'Berserker',
       3 => 'Caster',
       4 => 'Lancer',
       5 => 'Rider',
       6 => 'Saber'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */


    private $id;

    /**
     * 
     *
     * @var string|integer|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * Undocumented variable
     * @Assert\Image(
     *      mimeTypes= {"image/jpeg", "image/png"},
     *      mimeTypesMessage = "L'image choisit n'est pas valide",
     *      notFoundMessage = "L'image n'a pas été trouvée",
     *      uploadErrorMessage = "Erreur dans l'upload de l'image"
     * )
     * @Vich\UploadableField(mapping="servant_image", fileNameProperty="filename")
     * @var File|null
     */
    private $imagefile;

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
     * @Assert\Length(min=6, max=255)
     * @ORM\Column(type="text")
     */
    private $Noble_Phantasme;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Master", inversedBy="Servant")
     * cascade={"persist"}
     */
    private $Master;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;



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

    public function getClassType(): ?string
    {
        return self::CLASSE[$this->Class];
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

    /**
     * Get the value of ClassName
     */ 
    public function getClassName()
    {
        return $this->getClassType().' = '.$this->Name;
    }


    /* *
     * Set the value of ClassName
     *
     * @return  self
     */ 
    /* public function setClassName($ClassName)
    {
        $this->ClassName = $ClassName;

        return $this;
    } */

    /**
     * Get the value of filename
     *
     * @return  string|null
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @param  string|null  $filename
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  File|null
     */ 
    public function getImagefile(): ?File
    {
        return $this->imagefile;
    }

    /**
     * Set undocumented variable
     *
     * @param  File|null  $imagefile  Undocumented variable
     *
     * @return  self
     */ 
    public function setImagefile(?File $imagefile): Servant
    {
        $this->imagefile = $imagefile;
        if ($this->imagefile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
