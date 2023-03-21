<?php

namespace App\Repository;

use App\Entity\XmlFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<XmlFile>
 *
 * @method XmlFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method XmlFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method XmlFile[]    findAll()
 * @method XmlFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XmlFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XmlFile::class);
    }

    public function save(XmlFile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(XmlFile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return XmlFile[] Returns an array of XmlFile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('x')
//            ->andWhere('x.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('x.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?XmlFile
//    {
//        return $this->createQueryBuilder('x')
//            ->andWhere('x.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
