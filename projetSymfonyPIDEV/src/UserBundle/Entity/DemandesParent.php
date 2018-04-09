<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandesParent
 *
 * @ORM\Table(name="demandes_parent", indexes={@ORM\Index(name="id_parent", columns={"id_parent"})})
 * @ORM\Entity
 */
class DemandesParent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="datetime", nullable=true)
     */
    private $heureDebut;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="datetime", nullable=true)
     */
    private $heureFin;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBabysitter", referencedColumnName="id")
     * })
     */
    private $idBabysitter;     /**
/**
 * @var integer
 *
 * @ORM\Column(name="etat", type="integer", nullable=true)
 */
    private $etat;
    /**
    /**
     * @var integer
     *
     * @ORM\Column(name="nbApp", type="integer", nullable=true)
     */
    private $nbApp;

    /**
     * @return int
     */
    public function getNbApp()
    {
        return $this->nbApp;
    }

    /**
     * @param int $nbApp
     */
    public function setNbApp($nbApp)
    {
        $this->nbApp = $nbApp;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    /**
     * @return int
     */
    public function getIdDemande()
    {
        return $this->idDemande;
    }

    /**
     * @param int $idDemande
     */
    public function setIdDemande($idDemande)
    {
        $this->idDemande = $idDemande;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param \DateTime $heureDebut
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param \DateTime $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return \User
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @param \User $idParent
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
    }

    /**
     * @return \User
     */
    public function getIdBabysitter()
    {
        return $this->idBabysitter;
    }

    /**
     * @param \User $idBabysitter
     */
    public function setIdBabysitter($idBabysitter)
    {
        $this->idBabysitter = $idBabysitter;
    }


}

