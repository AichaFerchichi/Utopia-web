<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluations
 *
 * @ORM\Table(name="evaluations", indexes={@ORM\Index(name="id_enseignant", columns={"id_enseignant"})})
 * @ORM\Entity
 */
class Evaluations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evaluation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=50, nullable=false)
     */
    private $matiere;

    /**
     * @var float
     *
     * @ORM\Column(name="moyenne", type="float", precision=10, scale=0, nullable=false)
     */
    private $moyenne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_enseignant", type="string", length=200, nullable=false)
     */
    private $nomEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_enfant", type="string", length=50, nullable=false)
     */
    private $nomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_enfant", type="string", length=50, nullable=false)
     */
    private $prenomEnfant;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_enseignant", referencedColumnName="id")
     * })
     */
    private $idEnseignant;


}

