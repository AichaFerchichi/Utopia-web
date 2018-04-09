<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CheckQuiz
 *
 * @ORM\Table(name="checkQuiz")
 * @ORM\Entity
 */
class CheckQuiz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Quiz
     *
     * @ORM\ManyToOne(targetEntity="Quiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuiz", referencedColumnName="id_quiz")
     * })
     */
    private $idQuiz;
    /**
     * @var int
     *
     * @ORM\Column(name="en1", type="integer", nullable=false)
     */
    private $en1;
    /**
     * @var int
     *
     * @ORM\Column(name="en2", type="integer", nullable=false)
     */
    private $en2;
    /**
     * @var int
     *
     * @ORM\Column(name="en3", type="integer", nullable=false)
     */
    private $en3;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Quiz
     */
    public function getIdQuiz()
    {
        return $this->idQuiz;
    }

    /**
     * @param \Quiz $idQuiz
     */
    public function setIdQuiz($idQuiz)
    {
        $this->idQuiz = $idQuiz;
    }

    /**
     * @return int
     */
    public function getEn1()
    {
        return $this->en1;
    }

    /**
     * @param int $en1
     */
    public function setEn1($en1)
    {
        $this->en1 = $en1;
    }

    /**
     * @return int
     */
    public function getEn2()
    {
        return $this->en2;
    }

    /**
     * @param int $en2
     */
    public function setEn2($en2)
    {
        $this->en2 = $en2;
    }

    /**
     * @return int
     */
    public function getEn3()
    {
        return $this->en3;
    }

    /**
     * @param int $en3
     */
    public function setEn3($en3)
    {
        $this->en3 = $en3;
    }



}

