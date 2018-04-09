<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;


/**
 * Produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity
 */
class Produits
{
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
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return float
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * @param float $prixProduit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;

    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=2000, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=50, nullable=false)
     */
    private $categorie;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="Please, upload an image.")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=2000, nullable=true)
     */
    private $image;


    /**
     * @var integer
     *
     * @ORM\Column(name="promotion", type="integer", nullable=false)
     */
    private $promotion;

    /**
     * @var float
     *
     * @ORM\Column(name="nouvPrix", type="float", precision=10, scale=0, nullable=false)
     */
    private $nouvPrix;

    /**
     * @return float
     */
    public function getNouvPrix()
    {
        return $this->nouvPrix;
    }

    /**
     * @param float $nouvPrix
     */
    public function setNouvPrix($nouvPrix)
    {
        $this->nouvPrix = $nouvPrix;
    }

    /**
     * @return int
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param int $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * @return int
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param int $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;


   /* public function getWebPath(){
        return null===$this->image ? null : $this->getUploadDir.'/'.$this->image ;

    }

    protected function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir(){
        return 'images' ;
    }

    public function UploadProductPicture(){
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName()) ;
        $this->image=$this->file->getClientOriginalName() ;
        $this->file=null ;
    }*/




}

