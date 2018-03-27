<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="idC", columns={"idC"})})
 * @ORM\Entity
 */
class Reservations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_place", type="integer", nullable=false)
     */
    private $nbrePlace;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Covoiturages
     *
     * @ORM\ManyToOne(targetEntity="Covoiturages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idC", referencedColumnName="id")
     * })
     */
    private $idc;

    /**
     * @return int
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param int $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @return int
     */
    public function getNbrePlace()
    {
        return $this->nbrePlace;
    }

    /**
     * @param int $nbrePlace
     */
    public function setNbrePlace($nbrePlace)
    {
        $this->nbrePlace = $nbrePlace;
    }

    /**
     * @return \User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \User $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return \Covoiturages
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * @param \Covoiturages $idc
     */
    public function setIdc($idc)
    {
        $this->idc = $idc;
    }


}

