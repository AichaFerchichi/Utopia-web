<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffresBabysitter
 *
 * @ORM\Table(name="offres_babysitter", indexes={@ORM\Index(name="id_babysitter", columns={"id_babysitter"})})
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
 * @ORM\Column(name="fumeuse", type="string", length=100, nullable=false)
 */
    private $fumeuse;   /**
 * @var string
 *
 * @ORM\Column(name="enfant", type="string", length=100, nullable=false)
 */
    private $enfant;   /**
 * @var string
 *
 * @ORM\Column(name="conduite", type="string", length=100, nullable=false)
 */
    private $conduite;   /**
 * @var string
 *
 * @ORM\Column(name="agregation", type="string", length=100, nullable=false)
 */
    private $agregation;   /**
 * @var string
 *
 * @ORM\Column(name="dispo", type="string", length=100, nullable=false)
 */
    private $dispo;   /**
 * @var string
 *
 * @ORM\Column(name="image", type="string", length=100, nullable=false)
 */
    private $image;   /**
 * @var string
 *
 * @ORM\Column(name="video", type="string", length=100, nullable=false)
 */
    private $video;   /**

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     */

    private $dateNaissance;



    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_babysitter", referencedColumnName="id")
     * })
     */
    private $idBabysitter;

    /**
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
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
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param \DateTime $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
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

