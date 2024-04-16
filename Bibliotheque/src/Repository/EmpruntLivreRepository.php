<?php

namespace App\Repository;

use App\Entity\EmpruntLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmpruntLivre>
 *
 * @method EmpruntLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmpruntLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmpruntLivre[]    findAll()
 * @method EmpruntLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmpruntLivre::class);
    }

    //    /**
    //     * @return EmpruntLivre[] Returns an array of EmpruntLivre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EmpruntLivre
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
