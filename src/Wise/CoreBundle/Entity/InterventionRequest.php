<?php

namespace Wise\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionRequest
 *
 * @ORM\Table(name="intervention_request")
 * @ORM\Entity(repositoryClass="Wise\CoreBundle\Repository\InterventionRequestRepository")
 */
class InterventionRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wise\CoreBundle\Entity\Bail", cascade={"persist"})
     */
    private $bail;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return InterventionRequest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return InterventionRequest
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return InterventionRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set bail
     *
     * @param \Wise\CoreBundle\Entity\Bail $bail
     *
     * @return InterventionRequest
     */
    public function setBail(\Wise\CoreBundle\Entity\Bail $bail = null)
    {
        $this->bail = $bail;

        return $this;
    }

    /**
     * Get bail
     *
     * @return \Wise\CoreBundle\Entity\Bail
     */
    public function getBail()
    {
        return $this->bail;
    }
}
