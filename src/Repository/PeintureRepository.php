<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Advert;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Peinture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peinture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peinture[]    findAll($filters = null)
 * @method Peinture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }


    /**
     * @return void
     */
   /* public function getPeintures($filters = null){
        $query = $this->createQueryBuilder('a')
            ->where('a.active = 1');

        // On filtre les données
        if($filters != null){
            $query->andWhere('a.categories IN(:cats)')
                ->setParameter(':cats', array_values($filters));
        }
        return $this->createQueryBuilder('a')->getQuery()->getResult();
    }
*/
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Peinture $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Peinture $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Peinture[]
     */
    public function findSearch(SearchData $search): array

    {
        $query =$this
            ->createQueryBuilder('p')
            ->select('c','p')
            ->join('p.categorie','c');

        if (!empty($search->categories))
        {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);

        }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Peinture[] Returns an array of Peinture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Peinture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
