<?php

namespace test\WiseCoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use MongoDB\Driver\Manager;
use PHPUnit\Framework\TestCase;
use Wise\CoreBundle\Entity\Tenant;
use Wise\CoreBundle\Manager\TenantManager;
use Wise\CoreBundle\Repository\TenantRepository;

class TenantManagerTest extends TestCase
{
    private $manager;
    private $repository;
    private $em;

    public function setUp()
    {
        $this->em = $this->getMockBuilder(EntityManager::class)
            ->setMethods(['persist', 'flush'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        /*
        $this->manager = $this->getMockBuilder(TenantManager::class)
            ->setMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        */

        $this->repository = $this->createMock(TenantRepository::class);

        $this->manager = new TenantManager($this->em, $this->repository);
    }
    /**
     *
        public function save(Tenant $tenant)
        {
            if (null == $tenant && !isInstanceOf(Tenant::class)) {
                throw new \Exception("Objet null ou mauvaise instance");
            }
            $this->em->persist($tenant);
            $this->em->flush();
            return $tenant;
        }
     */
    public function testSave()
    {
        $tenant = new Tenant();
        $tenant->setPrenom('Domingo');
        $tenant->setNom('Santo');
        $tenant->setPseudo('Dulce');
        $tenant->setEmail('lolo@gmail.com');

        $this->em
            ->expects($this->once())
            ->method('persist')
            ->with($tenant)
        ;
        $this->em
            ->expects($this->once())
            ->method('flush')
        ;

        $this->manager->save($tenant);
    }
}