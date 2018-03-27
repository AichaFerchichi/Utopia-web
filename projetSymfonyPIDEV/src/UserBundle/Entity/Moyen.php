<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moyen
 *
 * @ORM\Table(name="moyen", indexes={@ORM\Index(name="id_enfant", columns={"id_enfant"})})
 * @ORM\Entity
 */
class Moyen
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
     * @var integer
     *
     * @ORM\Column(name="id_enfant", type="integer", nullable=false)
     */
    private $idEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr", type="integer", nullable=false)
     */
    private $nbr;


}

