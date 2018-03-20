<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseignants
 *
 * @ORM\Table(name="enseignants")
 * @ORM\Entity
 */
class Enseignants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_enseignant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=50, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=50, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_club", type="string", length=50, nullable=false)
     */
    private $nomClub;

    /**
     * @var float
     *
     * @ORM\Column(name="salaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $salaire;


}

