<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enfantsj
 *
 * @ORM\Table(name="enfantsj", indexes={@ORM\Index(name="id_parent", columns={"id_parent"}), @ORM\Index(name="id_jardinEnfant", columns={"id_jardinEnfant"})})
 * @ORM\Entity
 */
class Enfantsj
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
     * @ORM\Column(name="image", type="string", length=200, nullable=false)
     */
    private $image;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;

    /**
     * @var \Jardinenfants
     *
     * @ORM\ManyToOne(targetEntity="Jardinenfants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jardinEnfant", referencedColumnName="id_jardinEnfant")
     * })
     */
    private $idJardinenfant;


}

