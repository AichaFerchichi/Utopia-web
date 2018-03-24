<?php

namespace UserBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffresBabysitter
 *
 * @ORM\Table(name="offres_babysitter", indexes={@ORM\Index(name="idbb", columns={"idbb"})})
 * @ORM\Entity
 */
class OffresBabysitter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;



    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=100, nullable=false)
     */
    private $sexe;
    /**
     * @var string
     *
     * @ORM\Column(name="numtel", type="string", length=100, nullable=false)
     */
    private $numtel;
    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=100, nullable=false)
     */
    private $experience;
    /**
     * @var string
     *
     * @ORM\Column(name="lieu_baby", type="string", length=100, nullable=false)
     */
    private $lieu_baby;   /**
 * @var string
 *
 * @ORM\Column(name="fumeuse", type="string", length=100, nullable=true)
 */
    private $fumeuse;
    /**
     * @var string
     *
     * @ORM\Column(name="nfumeuse", type="string", length=100, nullable=true)
     */
    private $nfumeuse;
 /**
     * @var integer
     * @Assert\Range(min=18,max=65)
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
  */
    private $age;

    /**
 * @var string
 *
 * @ORM\Column(name="enfant", type="string", length=100, nullable=true)
 */
    private $enfant;
    /**
     * @var string
     *
     * @ORM\Column(name="nenfant", type="string", length=100, nullable=true)
     */
    private $nenfant; /**
 * @var string
 *
 * @ORM\Column(name="conduite", type="string", length=100, nullable=true)
 */
    private $conduite;
    /**
     * @var string
     *
     * @ORM\Column(name="nconduite", type="string", length=100, nullable=true)
     */
    private $nconduite; /**
 * @var string
 *
 * @ORM\Column(name="agregation", type="string", length=100, nullable=true)
 */
    private $agregation;
    /**
     * @var string
     *
     * @ORM\Column(name="nagregation", type="string", length=100, nullable=true)
     */
    private $nagregation;/**
 * @var string
 *
 * @ORM\Column(name="dispo", type="string", length=100, nullable=true)
 */
    private $dispo;
    /**
 * @var string
 *
 * @ORM\Column(name="image", type="string", length=100, nullable=false)
 */
    private $image;     /**



    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idbb", referencedColumnName="id")
     * })
     */
    private $idbb;


    /**
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @param int $idOffre
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;
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
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param string $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    /**
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param string $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return string
     */
    public function getLieuBaby()
    {
        return $this->lieu_baby;
    }

    /**
     * @param string $lieu_baby
     */
    public function setLieuBaby($lieu_baby)
    {
        $this->lieu_baby = $lieu_baby;
    }

    /**
     * @return string
     */
    public function getFumeuse()
    {
        return $this->fumeuse;
    }

    /**
     * @param string $fumeuse
     */
    public function setFumeuse($fumeuse)
    {
        $this->fumeuse = $fumeuse;
    }

    /**
     * @return string
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @param string $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }

    /**
     * @return string
     */
    public function getConduite()
    {
        return $this->conduite;
    }

    /**
     * @param string $conduite
     */
    public function setConduite($conduite)
    {
        $this->conduite = $conduite;
    }

    /**
     * @return string
     */
    public function getAgregation()
    {
        return $this->agregation;
    }

    /**
     * @param string $agregation
     */
    public function setAgregation($agregation)
    {
        $this->agregation = $agregation;
    }

    /**
     * @return string
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * @param string $dispo
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;
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
     * @return string
     */
    public function getNfumeuse()
    {
        return $this->nfumeuse;
    }

    /**
     * @param string $nfumeuse
     */
    public function setNfumeuse($nfumeuse)
    {
        $this->nfumeuse = $nfumeuse;
    }

    /**
     * @return string
     */
    public function getNenfant()
    {
        return $this->nenfant;
    }

    /**
     * @param string $nenfant
     */
    public function setNenfant($nenfant)
    {
        $this->nenfant = $nenfant;
    }

    /**
     * @return string
     */
    public function getNconduite()
    {
        return $this->nconduite;
    }

    /**
     * @param string $nconduite
     */
    public function setNconduite($nconduite)
    {
        $this->nconduite = $nconduite;
    }

    /**
     * @return string
     */
    public function getNagregation()
    {
        return $this->nagregation;
    }

    /**
     * @param string $nagregation
     */
    public function setNagregation($nagregation)
    {
        $this->nagregation = $nagregation;
    }

    /**
     * @return \User
     */
    public function getIdbb()
    {
        return $this->idbb;
    }

    /**
     * @param \User $idbb
     */
    public function setIdbb($idbb)
    {
        $this->idbb = $idbb;
    }


}

