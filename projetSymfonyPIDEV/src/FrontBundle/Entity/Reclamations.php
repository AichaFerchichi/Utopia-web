<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="id_babysitter", columns={"id_babysitter"}), @ORM\Index(name="id_parent", columns={"id_parent"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="datetime", nullable=false)
     */
    private $dateEnvoi = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_travail", type="time", nullable=false)
     */
    private $heureTravail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_pointe", type="time", nullable=false)
     */
    private $heurePointe;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="diff_heure", type="integer", nullable=true)
     */
    private $diffHeure;

    /**
     * @var integer
     *
     * @ORM\Column(name="diff_minute", type="integer", nullable=true)
     */
    private $diffMinute;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_babysitter", referencedColumnName="id")
     * })
     */
    private $idBabysitter;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;


}

