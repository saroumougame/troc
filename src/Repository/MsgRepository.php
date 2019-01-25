<?php

namespace App\Repository;

use App\Entity\Msg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Controller\EntityManagerInterface;

/**
 * @method Msg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Msg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Msg[]    findAll()
 * @method Msg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MsgRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Msg::class);
    }

    public function findAllMsg($une, $deux)
    {
        return $this->createQueryBuilder('msg')
            ->andWhere('msg.id_sender = ' . $une . ' and msg.id_receiver =' . $deux)
            ->orWhere('msg.id_sender = ' . $deux . ' and msg.id_receiver =' . $une)
            ->orderBy('msg.updated_at', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    

    // /**
    //  * @return Msg[] Returns an array of Msg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Msg
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
