<?php

namespace UserBundle\Repository;

/**
 * PromotionsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromotionsRepository extends \Doctrine\ORM\EntityRepository
{
    public function deleteCondition()
    {
        $qb = $this->getEntityManager()->createQuery("delete from UserBundel:Promotions as p where p.dateFin>CURRENT_DATE()") ;
        return $qb->getResult();
    }

    public function findSome()
    {
        $qb = $this->getEntityManager()->createQuery("select p from UserBundel:Promotions as p where p.categorie='vêtements' limit 4") ;
        return $qb->getResult();
    }
}
