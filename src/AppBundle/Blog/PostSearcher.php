<?php

namespace AppBundle\Blog;

use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityRepository;

class PostSearcher
{
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(EntityRepository $repository, RouterInterface $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

    /**
     * Search posts.
     *
     * @param string $query
     *
     * @return array
     */
    public function search($query)
    {
        return array(
            array('Test response 1', 'testurl1'),
            array('Test response 2', 'testurl2'),
            array('Test response 3', 'testurl3'),
            array('Test response 4', 'testurl4'),
        );
    }
}
