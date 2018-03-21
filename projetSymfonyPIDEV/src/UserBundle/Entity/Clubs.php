<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="date_ajout", type="datetime", nullable=false)
     */
    private $dateAjout = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=200, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
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


}

