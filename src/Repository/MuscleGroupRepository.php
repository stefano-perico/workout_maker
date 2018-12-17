<?php

namespace App\Repository;

use App\Entity\MuscleGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MuscleGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MuscleGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MuscleGroup[]    findAll()
 * @method MuscleGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuscleGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MuscleGroup::class);
    }

//    /**
//     * @return MuscleGroup[] Returns an array of MuscleGroup objects
//     */
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
    public function findOneBySomeField($value): ?MuscleGroup
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
