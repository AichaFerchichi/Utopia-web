<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="id_produit", columns={"id_produit"}), @ORM\Index(name="commentaires_ibfk_3", columns={"id_parent"})})
 * @ORM\Entity
 */
class Commentaires
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=5000, nullable=false)
     */
    private $contenu;

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

