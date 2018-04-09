<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuiz;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=2000, nullable=false)
     */
    private $theme;

    /**
     * @var string
     *@Assert\NotBlank(message="Please, upload an image.")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=2000, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=2000, nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep1", type="string", length=2000, nullable=false)
     */
    private $rep1;

    /**
     * @var string
     *
     * @ORM\Column(name="rep2", type="string", length=2000, nullable=false)
     */
    private $rep2;

    /**
     * @var string
     *
     * @ORM\Column(name="rep3", type="string", length=2000, nullable=false)
     */
    private $rep3;

    /**
     * @var string
     *
     * @ORM\Column(name="repC", type="string", length=2000, nullable=false)
     */
    private $repc;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @return int
     */
    public function getIdQuiz()
    {
        return $this->idQuiz;
    }

    /**
     * @param int $idQuiz
     */
    public function setIdQuiz($idQuiz)
    {
        $this->idQuiz = $idQuiz;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
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
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getRep1()
    {
        return $this->rep1;
    }

    /**
     * @param string $rep1
     */
    public function setRep1($rep1)
    {
        $this->rep1 = $rep1;
    }

    /**
     * @return string
     */
    public function getRep2()
    {
        return $this->rep2;
    }

    /**
     * @param string $rep2
     */
    public function setRep2($rep2)
    {
        $this->rep2 = $rep2;
    }

    /**
     * @return string
     */
    public function getRep3()
    {
        return $this->rep3;
    }

    /**
     * @param string $rep3
     */
    public function setRep3($rep3)
    {
        $this->rep3 = $rep3;
    }

    /**
     * @return string
     */
    public function getRepc()
    {
        return $this->repc;
    }

    /**
     * @param string $repc
     */
    public function setRepc($repc)
    {
        $this->repc = $repc;
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


}

