<?php

namespace App\Repository;

use App\Entity\Workout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Workout|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workout|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workout[]    findAll()
 * @method Workout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Workout::class);
    }

    /**
     * @return Workout[] Returns an array of Workout objects
     */
    public function findAllPublishedWorkoutByNewest()
    {
        return $this->addPublishedWorkout()
            ->orderBy('w.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    private function addPublishedWorkout(QueryBuilder $qb = null){
        return $this->createQueryBuilder($qb)
            ->andWhere('w.publishedAt IS NOT NULL');
    }

    private function getOrCreatQueryBuilder(QueryBuilder $qb = null){
        return $qb ?: $this->createQueryBuilder($qb);
    }

//    /**
//     * @return Workout[] Returns an array of Workout objects
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
    public function findOneBySomeField($value): ?Workout
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
