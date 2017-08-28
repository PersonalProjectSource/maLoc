<?php

namespace Wise\CoreBundle\Manager;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Tenant;
use Wise\CoreBundle\Repository\TenantRepository;

class TenantManager implements TenantManagerInterface
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em, TenantRepository $repository)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * Save entity from request data.
     *
     * @param Tenant $tenant
     * @throws \Exception
     * @internal param Request $request
     */
    public function save(Tenant $tenant)
    {
        if (null == $tenant && !isInstanceOf(Tenant::class)) {
            throw new \Exception("Objet null ou mauvaise instance");
        }

        $this->em->persist($tenant);
        $this->em->flush();

        return $tenant;
    }
}