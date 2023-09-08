<?php

// src/Repository/AssistRepository.php

namespace App\Repository;

use App\Entity\Assist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Assist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assist[]    findAll()
 * @method Assist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assist::class);
    }

    public function findEntitiesByString($str) {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from(Assist::class, 'e')
            ->where('e.question LIKE :str')
            ->setParameter('str', '%' . $str . '%')
            ->getQuery()
            ->getResult();
    }

}
