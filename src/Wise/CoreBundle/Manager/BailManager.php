<?php
namespace Wise\CoreBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Wise\CoreBundle\Entity\Bail;


class BailManager implements IManager
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em, EntityRepository $repository)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @param Bail $bail
     */
    public function save(Bail $bail)
    {
        $this->em->persist($bail);
        $this->em->flush();
    }
}