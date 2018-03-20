<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userquiz
 *
 * @ORM\Table(name="userquiz", indexes={@ORM\Index(name="id_quiz", columns={"id_quiz"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Userquiz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_userquiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserquiz;

    /**
     * @var \Quiz
     *
     * @ORM\ManyToOne(targetEntity="Quiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quiz", referencedColumnName="id_quiz")
     * })
     */
    private $idQuiz;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;


}

