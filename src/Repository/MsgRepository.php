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

    public function findAllMsg($sender, $receiver)
    {
        return $this->createQueryBuilder('msg')
            ->andWhere('msg.id_sender = :sender and msg.id_receiver = :receiver')
            ->orWhere('msg.id_sender = :receiver and msg.id_receiver = :sender')
            ->orderBy('msg.updated_at', 'ASC')
            ->setParameter('sender', $sender)
            ->setParameter('receiver', $receiver)
            ->getQuery()
            ->getResult();
    }

}
