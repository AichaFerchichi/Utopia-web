<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeClub
 *
 * @ORM\Table(name="demande_club", indexes={@ORM\Index(name="nom_club", columns={"nom_club"})})
 * @ORM\Entity
 */
class DemandeClub
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @ORM\Column(name="nombre_personnels", type="integer", nullable=false)
     */
    private $nombrePersonnels;

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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @var \Clubs
     *
     * @ORM\ManyToOne(targetEntity="Clubs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_club", referencedColumnName="nom_club")
     * })
     */
    private $nomClub;


}

