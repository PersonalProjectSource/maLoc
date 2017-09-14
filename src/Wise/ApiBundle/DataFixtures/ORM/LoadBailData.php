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
use Wise\CoreBundle\Entity\Property;

class LoadBailData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $bail = new Bail();
        $bail->setLoyer(370);
        $bail->setActif(true);
        $bail->setCaution(800);
        $bail->setDateDebut(new \DateTime('now'));
        $bail->setDateBailEnded(new \DateTime('2018-01-16'));
        $bail->setMeuble(true);
        $bail->setType(1);

        $property = new Property();
        $property->setNumero(7);
        $property->setAdresse('boulevard Marc LECLERC 49100 Angers');
        $property->setResidence('La Baumette');
        $property->setOwner();
        $property->setActif(true);
        $property->setBailDuration('21-07-17');
        $property->setLibelle('Studio meublé');

        $bail->setProperty($property);

        $bail2 = new Bail();
        $bail2->setLoyer(650);
        $bail2->setActif(true);
        $bail2->setCaution(1200);
        $bail2->setDateDebut(new \DateTime('now'));
        $bail2->setDateBailEnded(new \DateTime('2018-05-06'));
        $bail2->setMeuble(true);
        $bail2->setType(1);

        $manager->persist($bail);
        $manager->persist($bail2);

        $manager->flush();
    }
}