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

class LoadPropertyData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $property = new Property();
        $property->setLibelle('La baumette');
        $property->setAdresse('boulevard Marc LECLERC');
        $property->setNumero(7);
        $property->setActif(true);
        $property->setBailDuration('2018-11-1');
        $property->setResidence('Proche gare');

        $manager->persist($property);
        $manager->flush();
    }
}