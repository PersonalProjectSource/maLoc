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
use Wise\CoreBundle\Entity\Event;
use Wise\CoreBundle\Entity\Owner;
use Wise\CoreBundle\Entity\Property;
use Wise\CoreBundle\Entity\Tenant;

class LoadOwnerData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $owner = new Owner();
        $owner->setEmail('laurent.brau@free.fr');
        $owner->setPseudo('superLolo');
        $owner->setNom('BRAU');
        $owner->setPrenom('Laurent');
        $event = new Event();
        $event->setEnable(true);
        $owner->addEvent($event);
        $property = new Property();
        $property->setResidence('La baumette');
        $property->setBailDuration('21-10-2017');
        $property->setAdresse('Boulevard Marc Leclerc');
        $property->setLibelle('Studio meublé');
        $property->setActif(true);
        $property->setNumero(7);

        $owner->addProperty($property);

        $manager->persist($owner);
        $manager->persist($event);
        $manager->persist($property);
        $manager->flush();
    }
}