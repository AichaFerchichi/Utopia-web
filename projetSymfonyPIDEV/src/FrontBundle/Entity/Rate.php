<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate", indexes={@ORM\Index(name="nom_club", columns={"nom_club"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Rate
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
     * @ORM\Column(name="aimer", type="integer", nullable=true)
     */
    private $aimer = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pasaimer", type="integer", nullable=true)
     */
    private $pasaimer = '0';

    /**
     * @var \Clubs
     *
     * @ORM\ManyToOne(targetEntity="Clubs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_club", referencedColumnName="nom_club")
     * })
     */
    private $nomClub;

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

