<?php

namespace Wise\CoreBundle\Entity\Traits;

trait DateTimeTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", length=255)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="updatedAt", type="datetime", length=255)
     */
    private $updatedAt;
}