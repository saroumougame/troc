<?php


namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;


class ObjetRepository extends EntityRepository
{
    public function liste(){

    }


    public function getObjetBySearch($param)
    {

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('o')
            ->from('App:Objet', 'o');
        $qb->where(
            $qb->expr()->like('o.nom', ':nom')
        )
            ->setParameter('nom', '%' . $param['nom'] . '%');
        return $qb->getQuery()->getResult();
    }


    public function getObjetSell($params)
    {

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('o')
            ->from('App:Objet', 'o');
        $qb->where(
            'o.user != :user'
        )
            ->setParameter('user', $params['user']);
        return $qb->getQuery()->getResult();


    }


}