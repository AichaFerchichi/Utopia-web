<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeTravail
 *
 * @ORM\Table(name="demande_travail", indexes={@ORM\Index(name="id_babysitter", columns={"id_babysitter"})})
 * @ORM\Entity
 */
class DemandeTravail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demandeTravail", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemandetravail;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_etude", type="string", length=100, nullable=false)
     */
    private $niveauEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="poste_actuel", type="string", length=100, nullable=false)
     */
    private $posteActuel;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=100, nullable=false)
     */
    private $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=100, nullable=false)
     */
    private $numTel;

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

