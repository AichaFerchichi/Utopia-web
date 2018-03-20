<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffresBabysitter
 *
 * @ORM\Table(name="offres_babysitter", indexes={@ORM\Index(name="id_babysitter", columns={"id_babysitter"})})
 * @ORM\Entity
 */
class OffresBabysitter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime", nullable=true)
     */
    private $datePublication = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=5000, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_babysitter", referencedColumnName="id")
     * })
     */
    private $idBabysitter;


}

