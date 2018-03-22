<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoyensDeTransport
 *
 * @ORM\Table(name="moyens_de_transport")
 * @ORM\Entity
 */
class MoyensDeTransport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_moyenTransport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMoyentransport;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=50, nullable=false)
     */
    private $immatriculation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_de_place", type="integer", nullable=false)
     */
    private $nombreDePlace;

    /**
     * @return int
     */
    public function getIdMoyentransport()
    {
        return $this->idMoyentransport;
    }

    /**
     * @param int $idMoyentransport
     */
    public function setIdMoyentransport($idMoyentransport)
    {
        $this->idMoyentransport = $idMoyentransport;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * @param string $immatriculation
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;
    }

    /**
     * @return int
     */
    public function getNombreDePlace()
    {
        return $this->nombreDePlace;
    }

    /**
     * @param int $nombreDePlace
     */
    public function setNombreDePlace($nombreDePlace)
    {
        $this->nombreDePlace = $nombreDePlace;
    }


}

