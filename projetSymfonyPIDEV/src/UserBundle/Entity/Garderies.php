<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
/**
 * Garderies
 *
<<<<<<< HEAD
 * @ORM\Table(name="garderies")
=======
 * @ORM\Table(name="garderies", indexes={@ORM\Index(name="id_garderie", columns={"id_garderie"})})
>>>>>>> b4234a2331026ebef06f00803ffa4e02b4f84c6c
 * @ORM\Entity
 */
class Garderies
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_garderie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGarderie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_tel", type="integer", nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *@Assert\NotBlank(message="Please, upload an image.")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=200, nullable=true)
     */
    private $image;


    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="string", length=6555, nullable=true)
     */
    private $objectif;
    /**
     * @var string
     *
     * @ORM\Column(name="proEducatif", type="string", length=6555, nullable=true)
     */
    private $proEducatif;
    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=200, nullable=true)
     */
    private $Email;
    /**
     * @var int
     *
     * @ORM\Column(name="nb_place_dispo", type="integer", nullable=true)
     */
    private $nb_place_dispo;
    /**
     * @var int
     *
     * @ORM\Column(name="nbEnfant", type="integer", nullable=true)
     */
    private $nbEnfant;

    /**
     * @return int
     */
    public function getNbEnfant()
    {
        return $this->nbEnfant;
    }

    /**
     * @param int $nbEnfant
     */
    public function setNbEnfant($nbEnfant)
    {
        $this->nbEnfant = $nbEnfant;
    }


    /**
     * @return int
     */
    public function getIdGarderie()
    {
        return $this->idGarderie;
    }

    /**
     * @param int $idGarderie
     */
    public function setIdGarderie($idGarderie)
    {
        $this->idGarderie = $idGarderie;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param int $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * @return string
     */
    public function getObjectif()
    {
        return $this->objectif;
    }

    /**
     * @param string $objectif
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;
    }

    /**
     * @return string
     */
    public function getProEducatif()
    {
        return $this->proEducatif;
    }

    /**
     * @param string $proEducatif
     */
    public function setProEducatif($proEducatif)
    {
        $this->proEducatif = $proEducatif;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return int
     */
    public function getNbPlaceDispo()
    {
        return $this->nb_place_dispo;
    }

    /**
     * @param int $nb_place_dispo
     */
    public function setNbPlaceDispo($nb_place_dispo)
    {
        $this->nb_place_dispo = $nb_place_dispo;
    }


}

