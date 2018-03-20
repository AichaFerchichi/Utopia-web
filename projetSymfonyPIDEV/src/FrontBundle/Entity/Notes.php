<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notes
 *
 * @ORM\Table(name="notes", indexes={@ORM\Index(name="id_produit", columns={"id_produit"}), @ORM\Index(name="notes_ibfk_3", columns={"id_parent"})})
 * @ORM\Entity
 */
class Notes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_note", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNote;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_etoiles", type="string", length=20, nullable=false)
     */
    private $nbEtoiles;

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $idProduit;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;


}

