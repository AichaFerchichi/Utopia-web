<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membres
 *
 * @ORM\Table(name="membres", uniqueConstraints={@ORM\UniqueConstraint(name="nom", columns={"nom"}), @ORM\UniqueConstraint(name="prenom", columns={"prenom"})}, indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_club", columns={"id_club"})})
 * @ORM\Entity
 */
class Membres
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
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_club", type="integer", nullable=false)
     */
    private $idClub;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=false)
     */
    private $dateInscription = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_parent", type="integer", nullable=false)
     */
    private $numParent;

    /**
     * @var string
     *
     * @ORM\Column(name="email_parent", type="string", length=50, nullable=false)
     */
    private $emailParent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;


}

