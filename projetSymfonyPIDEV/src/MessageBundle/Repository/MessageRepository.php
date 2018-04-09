<?php
/**
 * Created by PhpStorm.
 * User: MedAmineBou
 * Date: 28/02/2018
 * Time: 02:22
 */

namespace MessageBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{

    public function findMessage($id,$body)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT m FROM MessageBundle:Message m WHERE m.thread=:id AND m.body LIKE :body")
            ->setParameter('body',$body)
            ->setParameter('id',$id);
        return $query->execute();
    }

}