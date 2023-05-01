<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TurorialRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TutorialRepository extends EntityRepository
{
    public function FindAllTutoriales()
    {
        $em=$this->getEntityManager();
        $dql="SELECT t FROM LRNProtectBundle:Tutorial t ORDER BY t.nombreRedSocial ASC";
        $query=$em->createQuery($dql);

        $entity=$query->getResult();
        return $entity;
    }

}
