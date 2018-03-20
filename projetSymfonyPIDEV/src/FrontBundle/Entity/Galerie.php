<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galerie
 *
 * @ORM\Table(name="galerie", uniqueConstraints={@ORM\UniqueConstraint(name="image", columns={"image"})}, indexes={@ORM\Index(name="id_club", columns={"id_club"})})
 * @ORM\Entity
 */
class Galerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_club", type="integer", nullable=false)
     */
    private $idClub;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=false)
     */
    private $image;


}

