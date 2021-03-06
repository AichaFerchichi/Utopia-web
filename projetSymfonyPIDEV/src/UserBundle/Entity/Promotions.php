<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotions
 *
 * @ORM\Table(name="promotions", indexes={@ORM\Index(name="id_produit", columns={"id_produit"})})
 * @ORM\Entity
 */
class Promotions
{
    /**
     * @return int
     */
    public function getIdPromo()
    {
        return $this->idPromo;
    }

    /**
     * @param int $idPromo
     */
    public function setIdPromo($idPromo)
    {
        $this->idPromo = $idPromo;
    }

    /**
     * @return int
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param int $pourcentage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
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
     * @return float
     */
    public function getPrixpromo()
    {
        return $this->prixpromo;
    }

    /**
     * @param float $prixpromo
     */
    public function setPrixpromo($prixpromo)
    {
        $this->prixpromo = $prixpromo;
    }

    /**
     * @return \Produits
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param \Produits $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_promo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPromo;

    /**
     * @var integer
     *
     * @ORM\Column(name="pourcentage", type="integer", nullable=false)
     */
    private $pourcentage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var float
     *
     * @ORM\Column(name="prixPromo", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixpromo;

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $idProduit;


}

