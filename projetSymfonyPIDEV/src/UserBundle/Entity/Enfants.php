<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enfants
 *
 * @ORM\Table(name="enfants", indexes={@ORM\Index(name="enfants_ibfk_1", columns={"id_parent"}), @ORM\Index(name="id_garderie", columns={"id_garderie"})})
 * @ORM\Entity
 */
class Enfants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_enfant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_enfant", type="string", length=50, nullable=false)
     */
    private $nomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;

    /**
     * @var \Garderies
     *
     * @ORM\ManyToOne(targetEntity="Garderies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_garderie", referencedColumnName="id_garderie")
     * })
     */
    private $idGarderie;


}

