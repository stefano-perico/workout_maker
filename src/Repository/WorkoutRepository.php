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
    public function findAllPublishedWorkoutByNewestWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.user', 'u')
            ->addSelect('u')
            ->andWhere('w.publishedAt IS NOT NULL')
        ;

        if ($term){
            $qb->andWhere('w.name LIKE :term OR w.description LIKE :term OR u.email LIKE :term')
                ->setParameter('term', '%'.$term.'%')
            ;
        }

        return $qb
            ->orderBy('w.publishedAt', 'DESC');
    }

    /**
     * @return Workout[] Returns an array of Workout objects
     */
    public function findThreeLastPublishedWorkouts()
    {
        return $this->createQueryBuilder('w')
            ->setMaxResults(3)
            ->orderBy('w.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param null|string $term
     */
    public function findAllWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.user', 'u')
            ->addSelect('u')
        ;

        if ($term){
            $qb->andWhere('w.name LIKE :term OR w.description LIKE :term OR u.email LIKE :term')
                ->setParameter('term', '%'.$term.'%')
            ;
        }

        return $qb
            ->orderBy('w.createdAt', 'DESC')
        ;
    }

    private function addPublishedWorkout(QueryBuilder $qb = null){
        return $this->getOrCreatQueryBuilder($qb)
            ->andWhere('w.publishedAt IS NOT NULL');
    }

    private function getOrCreatQueryBuilder(QueryBuilder $qb = null){
        return $qb ?: $this->createQueryBuilder('w');
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
