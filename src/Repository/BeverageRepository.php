<?php

namespace App\Repository;

use App\Entity\Beverage;
use App\Entity\BeverageCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beverage>
 *
 * @method Beverage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beverage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beverage[]    findAll()
 * @method Beverage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeverageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beverage::class);
    }

    public function save(Beverage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Beverage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllBeveragesWithCategory(string $beverageCategoryName)
    {
        return $this->createQueryBuilder('beverage')
            ->join(BeverageCategory::class, 'category', 'WITH', 'beverage.beverageCategory = category')
            ->where('category.beverageCategoryName = :categoryName')
            ->setParameter('categoryName', $beverageCategoryName)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Beverage[] Returns an array of Beverage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Beverage
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
