<?php

namespace App\Repository;

use App\Entity\Work;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Work|null find($id, $lockMode = null, $lockVersion = null)
 * @method Work|null findOneBy(array $criteria, array $orderBy = null)
 * @method Work[]    findAll()
 * @method Work[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Work::class);
    }

    // /**
    //  * @return Work[] Returns an array of Work objects
    //  */

    public function findAllByTag($values, $limit)
    {
      $final = array();
      $flag = false;
      foreach ($values as $value) {
        $tabWorks = array();
         array_push($tabWorks, $this->createQueryBuilder('w')
            ->leftJoin('w.tags','t')
            ->andWhere('t.id = :val')
            ->setParameter('val', $value->getId())
            ->orderBy('w.id', 'ASC')
            ->getQuery()
            ->getResult()
        );
        //boucle sur count de la reponse
        foreach ($tabWorks[0] as $work) {
            foreach ($final as $item) {
              if($item->getId() == $work->getId()):
                $flag = true;
              endif;
            }
            if(!$flag && count($final) < $limit):
              array_push($final, $work);
            endif;
        }
      }
      return $final;
    }

    // /**
    //  * @return Work[] Returns an array of Work objects
    //  */
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
    public function findOneBySomeField($value): ?Work
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
