<?php

namespace App\Repository;

use App\Entity\Beverage;
use App\Entity\Food;
use App\Entity\FoodCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Food>
 *
 * @method Food|null find($id, $lockMode = null, $lockVersion = null)
 * @method Food|null findOneBy(array $criteria, array $orderBy = null)
 * @method Food[]    findAll()
 * @method Food[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Food::class);
    }

    public function save(Food $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Food $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Food[] which are activ=true with a given category as a parameter
     */
    public function findAllActivFoodsWithCat(string $foodCategoryName)
    {
        return $this->createQueryBuilder('food')
            ->join(FoodCategory::class, 'category', 'WITH', 'food.foodCategory = category')
            ->where('category.foodCategoryName = :categoryName')
            ->andWhere('food.isActiv = :isActive')
            ->setParameter('categoryName', $foodCategoryName)
            ->setParameter('isActive', true) // Définition du paramètre isActive à true
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Food[] complete list for the admin with the category
     */
    public function findAllWithCategory(): array
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.foodCategory', 'fc')
            ->addSelect('fc') // Include the FoodCategory in the results
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @return Food[] Returns an array of Food objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Food
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
