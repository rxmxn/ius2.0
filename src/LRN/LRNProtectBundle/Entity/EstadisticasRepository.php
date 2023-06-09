<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 10:40
 */

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EstadisticasRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EstadisticasRepository extends EntityRepository
{
    public function FindAllCat()
    {
        $em=$this->getEntityManager();
        $dql='SELECT DISTINCT e.categoria FROM LRNProtectBundle:Estadisticas e ORDER BY e.categoria ASC ';
        $query=$em->createQuery($dql);
        $entity=$query->getResult();
        return $entity;
    }

    public function FindCat($categoria)
    {
        $em=$this->getEntityManager();
        $dql='SELECT e FROM LRNProtectBundle:Estadisticas e WHERE e.categoria= :categoria';
        $query=$em->createQuery($dql);
        $query->setParameter('categoria',$categoria);
        $entity=$query->getResult();
        return $entity;
    }

    public function FindAllEstadisticas()
    {
        $em=$this->getEntityManager();
        $dql='SELECT e FROM LRNProtectBundle:Estadisticas e ORDER BY e.categoria ASC ';
        $query=$em->createQuery($dql);
        $entity=$query->getResult();
        return $entity;
    }
}