<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
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


}

