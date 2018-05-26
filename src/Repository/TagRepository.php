<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * This custom Doctrine repository is empty because so far we don't need any custom
 * method to query for application user information. But it's always a good practice
 * to define a custom repository that will be used when the application grows.
 *
 * See https://symfony.com/doc/current/doctrine/repository.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function findMostPopular(int $limit = 10): array
    {
        $entityManager = $this->getEntityManager();

        $sql = '
            SELECT t.*, COUNT(pt.post_id) count
            FROM symfony_demo_tag t
            LEFT JOIN symfony_demo_post_tag pt ON pt.tag_id = t.id
            GROUP BY t.id
            ORDER BY count DESC, t.name ASC
            LIMIT ?
        ';

        $rsm = new ResultSetMappingBuilder($entityManager);
        $rsm->addRootEntityFromClassMetadata(Tag::class, 't');
        $rsm->addScalarResult('count', 'count', 'integer');

        $query = $entityManager
            ->createNativeQuery($sql, $rsm)
            ->setParameter(1, $limit)
        ;

        return $query->getResult();
    }
}
