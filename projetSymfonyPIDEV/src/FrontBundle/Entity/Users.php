<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="pseudo", columns={"pseudo"}), @ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

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
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_club", type="string", length=50, nullable=false)
     */
    private $nomClub;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=50, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=2000, nullable=true)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="alerte", type="integer", nullable=true)
     */
    private $alerte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=false)
     */
    private $dateInscription = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="Anciennete", type="integer", nullable=true)
     */
    private $anciennete;

    /**
     * @var integer
     *
     * @ORM\Column(name="disponibilite", type="integer", nullable=true)
     */
    private $disponibilite;


}

