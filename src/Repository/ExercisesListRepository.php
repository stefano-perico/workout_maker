<?php

namespace App\Repository;

use App\Entity\ExercisesList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExercisesList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExercisesList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExercisesList[]    findAll()
 * @method ExercisesList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExercisesListRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExercisesList::class);
    }

//    /**
//     * @return ExercisesList[] Returns an array of ExercisesList objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExercisesList
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
