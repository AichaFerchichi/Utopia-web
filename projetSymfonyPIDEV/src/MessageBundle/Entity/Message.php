<?php
/**
 * Created by PhpStorm.
 * User: MedAmineBou
 * Date: 10/02/2018
 * Time: 19:45
 */

namespace MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * Class Message
 * @package FrontBundle\Entity
 */

/**
 * @ORM\Entity(repositoryClass="MessageBundle\Repository\MessageRepository")
 */
class Message extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="MessageBundle\Entity\Thread",
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="MessageBundle\Entity\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|Collection
     */
    protected $metadata;

}