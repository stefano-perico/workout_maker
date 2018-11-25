<?php

namespace App\Repository;

use App\Entity\WorkoutExercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkoutExercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkoutExercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkoutExercise[]    findAll()
 * @method WorkoutExercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutExerciseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkoutExercise::class);
    }

//    /**
//     * @return WorkoutExercise[] Returns an array of WorkoutExercise objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkoutExercise
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
