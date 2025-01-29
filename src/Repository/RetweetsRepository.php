<?php

namespace App\Repository;

use App\Entity\Retweets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Retweets>
 */
class RetweetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retweets::class);
    }

    public function countRt($postId): int
    {
        $qb = $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->where('r.post = :postId')
            ->setParameter('postId', $postId);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    // public function countRt($postId){
    //     $sql = "SELECT COUNT * as retweet_count FROM Retweets WHERE post_id = :post_id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([':post_id' => $postId]);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result['retweet_count'] ?? 0;
    // }

    //    /**
    //     * @return Retweets[] Returns an array of Retweets objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Retweets
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
