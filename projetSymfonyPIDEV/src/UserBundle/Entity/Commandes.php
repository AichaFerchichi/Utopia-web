<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandes
 *
 * @ORM\Table(name="commandes", indexes={@ORM\Index(name="id_parent", columns={"id_parent"}), @ORM\Index(name="id_ligne", columns={"id_ligne"})})
 * @ORM\Entity
 */
class Commandes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=false)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * @param int $idCommande
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * @return \Lignecommandes
     */
    public function getIdLigne()
    {
        return $this->idLigne;
    }

    /**
     * @param \Lignecommandes $idLigne
     */
    public function setIdLigne($idLigne)
    {
        $this->idLigne = $idLigne;
    }

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
     * @var \Lignecommandes
     *
     * @ORM\ManyToOne(targetEntity="Lignecommandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ligne", referencedColumnName="id_ligne")
     * })
     */
    private $idLigne;


}

