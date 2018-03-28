<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Clubs
 *
 * @ORM\Table(name="clubs", uniqueConstraints={@ORM\UniqueConstraint(name="nom", columns={"nom_club"})})
 * @ORM\Entity
 */
class Clubs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_club", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClub;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin_proprietaire", type="integer", nullable=false)
     */
    private $cinProprietaire;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_club", type="string", length=50, nullable=false)
     */
    private $nomClub;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=50, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4000, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_membre", type="integer", nullable=false)
     */
    private $nombreMembre;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_personnels", type="integer", nullable=false)
     */
    private $nombrePersonnels;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=200, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *@Assert\NotBlank(message="Please, upload an image.")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=1000, nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalaimer", type="integer", nullable=true)
     */
    private $totalaimer = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="totalpasaimer", type="integer", nullable=true)
     */
    private $totalpasaimer = '0';

    /**
     * @return int
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * @param int $idClub
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return int
     */
    public function getCinProprietaire()
    {
        return $this->cinProprietaire;
    }

    /**
     * @param int $cinProprietaire
     */
    public function setCinProprietaire($cinProprietaire)
    {
        $this->cinProprietaire = $cinProprietaire;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * @param string $nomClub
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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
     * @return int
     */
    public function getNombreMembre()
    {
        return $this->nombreMembre;
    }

    /**
     * @param int $nombreMembre
     */
    public function setNombreMembre($nombreMembre)
    {
        $this->nombreMembre = $nombreMembre;
    }

    /**
     * @return int
     */
    public function getNombrePersonnels()
    {
        return $this->nombrePersonnels;
    }

    /**
     * @param int $nombrePersonnels
     */
    public function setNombrePersonnels($nombrePersonnels)
    {
        $this->nombrePersonnels = $nombrePersonnels;
    }

    /**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
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
     * @return int
     */
    public function getTotalaimer()
    {
        return $this->totalaimer;
    }

    /**
     * @param int $totalaimer
     */
    public function setTotalaimer($totalaimer)
    {
        $this->totalaimer = $totalaimer;
    }

    /**
     * @return int
     */
    public function getTotalpasaimer()
    {
        return $this->totalpasaimer;
    }

    /**
     * @param int $totalpasaimer
     */
    public function setTotalpasaimer($totalpasaimer)
    {
        $this->totalpasaimer = $totalpasaimer;
    }



}

