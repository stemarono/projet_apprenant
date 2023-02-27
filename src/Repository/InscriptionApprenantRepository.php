<?php

namespace App\Repository;

use App\Entity\InscriptionApprenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionApprenant>
 *
 * @method InscriptionApprenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionApprenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionApprenant[]    findAll()
 * @method InscriptionApprenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionApprenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionApprenant::class);
    }

    public function save(InscriptionApprenant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InscriptionApprenant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll()
    {
        $queryBuilder=$this->createQueryBuilder('p');// p est un alias c'est l'équivalent de product as p
        $queryBuilder->orderBy("p.nom","asc");
        return $queryBuilder->getQuery()->getResult();//$queryBuilder->getQuery()->getArrayResult();
        
    }

    public function findMot($mot)
    {
        //$queryBuilder = $qb
        $qb=$this->createQueryBuilder('p'); 
        if($mot!='0'){
            $qb->where("p.nom like :mot or p.prenom like :mot");
            $qb->setParameter('mot',"%$mot%");
            
        }
        $qb->orderBy("p.nom","asc");
            return $qb->getQuery()->getArrayResult(); // avoir un tableau au lieu d'un objet, getArrayResult remplace le foreach 
    }

//    /**
//     * @return InscriptionApprenant[] Returns an array of InscriptionApprenant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InscriptionApprenant
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
