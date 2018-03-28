<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturages
 *
 * @ORM\Table(name="covoiturages", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Covoiturages
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
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=50, nullable=false)
     */
    private $depart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDepart", type="date", nullable=false)
     */
    private $datedepart;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureD", type="string", length=50, nullable=false)
     */
    private $heured;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=false)
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateArrive", type="date", nullable=false)
     */
    private $datearrive;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureA", type="string", length=50, nullable=false)
     */
    private $heurea;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_place_dispo", type="integer", nullable=false)
     */
    private $nbrePlaceDispo;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param string $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
    }

    /**
     * @return \DateTime
     */
    public function getDatedepart()
    {
        return $this->datedepart;
    }

    /**
     * @param \DateTime $datedepart
     */
    public function setDatedepart($datedepart)
    {
        $this->datedepart = $datedepart;
    }

    /**
     * @return string
     */
    public function getHeured()
    {
        return $this->heured;
    }

    /**
     * @param string $heured
     */
    public function setHeured($heured)
    {
        $this->heured = $heured;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return \DateTime
     */
    public function getDatearrive()
    {
        return $this->datearrive;
    }

    /**
     * @param \DateTime $datearrive
     */
    public function setDatearrive($datearrive)
    {
        $this->datearrive = $datearrive;
    }

    /**
     * @return string
     */
    public function getHeurea()
    {
        return $this->heurea;
    }

    /**
     * @param string $heurea
     */
    public function setHeurea($heurea)
    {
        $this->heurea = $heurea;
    }

    /**
     * @return int
     */
    public function getNbrePlaceDispo()
    {
        return $this->nbrePlaceDispo;
    }

    /**
     * @param int $nbrePlaceDispo
     */
    public function setNbrePlaceDispo($nbrePlaceDispo)
    {
        $this->nbrePlaceDispo = $nbrePlaceDispo;
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


}

