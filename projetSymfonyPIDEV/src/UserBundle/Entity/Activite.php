<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity
 */
class Activite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idActivite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActivite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", nullable=false)
     */
    private $nom;



    /**
     * @var date
     *
     * @ORM\Column(name="dateDebut", type="date",  nullable=true)
     */
    private $dateDebut;
    /**
     * @var date
     *
     * @ORM\Column(name="dateFin", type="date",  nullable=true)
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbEtape", type="integer", nullable=false)
     */
    private $nbEtape;
    /**
     * @var \Garderies
     *
     * @ORM\ManyToOne(targetEntity="Garderies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGarderie", referencedColumnName="id_garderie")
     * })
     */
    private $idGarderie;

    /**
     * @return \Garderies
     */
    public function getIdGarderie()
    {
        return $this->idGarderie;
    }

    /**
     * @param \Garderies $idGarderie
     */
    public function setIdGarderie($idGarderie)
    {
        $this->idGarderie = $idGarderie;
    }



    /**
     * @return int
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     * @param int $idActivite
     */
    public function setIdActivite($idActivite)
    {
        $this->idActivite = $idActivite;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return date
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param date $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return date
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param date $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return int
     */
    public function getNbEtape()
    {
        return $this->nbEtape;
    }

    /**
     * @param int $nbEtape
     */
    public function setNbEtape($nbEtape)
    {
        $this->nbEtape = $nbEtape;
    }






}

