<?php

namespace Wise\CoreBundle\Manager;

use phpDocumentor\Reflection\Types\Object_;

class GenericManager
{
    private $manager;

    public function __construct(IManager $manager)
    {
        $this->manager = $manager;
    }

    public function save(Object_ $entity)
    {
        $this->manager->save($entity);
    }
}