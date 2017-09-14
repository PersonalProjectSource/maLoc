<?php

namespace Wise\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Repository\RepositoryFactory;
use phpDocumentor\Reflection\Types\Object_;
use Wise\CoreBundle\Entity\Bail;

interface IManager
{
    public function __construct(EntityManagerInterface $em, EntityRepository $repository);

    public function save(Bail $bail);
}