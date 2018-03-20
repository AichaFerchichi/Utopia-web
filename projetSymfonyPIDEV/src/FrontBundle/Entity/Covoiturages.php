<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturages
 *
 * @ORM\Table(name="covoiturages", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Covoiturages
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
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=50, nullable=false)
     */
    private $depart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDepart", type="date", nullable=false)
     */
    private $datedepart;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureD", type="string", length=50, nullable=false)
     */
    private $heured;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=false)
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateArrive", type="date", nullable=false)
     */
    private $datearrive;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureA", type="string", length=50, nullable=false)
     */
    private $heurea;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_place_dispo", type="integer", nullable=false)
     */
    private $nbrePlaceDispo;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;


}

