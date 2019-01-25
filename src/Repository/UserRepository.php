<?php



namespace App\Repository;
use App\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;




class UserRepository extends EntityRepository
{
    public function liste(){
    }

    public function getUserBySearch($param){

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('u')
            ->from('App:user', 'u');
        $qb->where(
            $qb->expr()->like('u.username', ':username')
        )
            ->setParameter('username', '%'.$param['username'].'%');
        return $qb->getQuery()->getResult();
    }





}