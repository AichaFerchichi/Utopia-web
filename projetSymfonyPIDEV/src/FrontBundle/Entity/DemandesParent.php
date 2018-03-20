<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandesParent
 *
 * @ORM\Table(name="demandes_parent", indexes={@ORM\Index(name="id_parent", columns={"id_parent"})})
 * @ORM\Entity
 */
class DemandesParent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=5000, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

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
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;


}

