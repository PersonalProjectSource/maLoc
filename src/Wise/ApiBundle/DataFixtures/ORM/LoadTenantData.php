<?php
/**
 * Created by PhpStorm.
 * User: laurentbrau
 * Date: 06/08/2017
 * Time: 11:17
 */

namespace Wise\ApiBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Wise\CoreBundle\Entity\Bail;
use Wise\CoreBundle\Entity\Tenant;

class LoadTenantData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tenant = new Tenant();
        $tenant->setEmail('laurent.bra@gmail.com');
        $tenant->setNom('BRA');
        $tenant->setPrenom('Laurent');
        $tenant->setPseudo('Optimus');

        $tenant2 = new Tenant();
        $tenant2->setEmail('cin.brossard@gmail.com');
        $tenant2->setNom('BROSSARD');
        $tenant2->setPrenom('Cindy');
        $tenant2->setPseudo('Cissoune');

        $tenant3 = new Tenant();
        $tenant3->setEmail('julien.darchy@gmail.com');
        $tenant3->setNom('DARCHY');
        $tenant3->setPrenom('Julien');
        $tenant3->setPseudo('Juju');

        $tenant4 = new Tenant();
        $tenant4->setEmail('laurent.gourouvin@gmail.com');
        $tenant4->setNom('GOUROUVIN');
        $tenant4->setPrenom('Laurent');
        $tenant4->setPseudo('TouChimous');

        $tenant5 = new Tenant();
        $tenant5->setEmail('brau_l@etna-alternance.net');
        $tenant5->setNom('BRAUETNA');
        $tenant5->setPrenom('LaurentETNA');
        $tenant5->setPseudo('OptimusETNA');

        $manager->persist($tenant);
        $manager->persist($tenant2);
        $manager->persist($tenant3);
        $manager->persist($tenant4);
        $manager->persist($tenant5);
        $manager->flush();
    }
}