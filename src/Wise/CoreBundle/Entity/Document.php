<?php

namespace Wise\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="Wise\CoreBundle\Repository\DocumentRepository")
 */
class Document
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
     * @ORM\ManyToOne(targetEntity="Wise\CoreBundle\Entity\Bail", inversedBy="document", cascade={"persist"})
     */
    private $bail;
    /**
     * @ORM\ManyToOne(targetEntity="Wise\CoreBundle\Entity\Property", inversedBy="document", cascade={"persist"})
     */
    private $property;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="descritption", type="text")
     */
    private $description;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Document
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set descritption
     *
     * @param string $descritption
     *
     * @return Document
     */
    public function setDescritption($descritption)
    {
        $this->descritption = $descritption;

        return $this;
    }

    /**
     * Get descritption
     *
     * @return string
     */
    public function getDescritption()
    {
        return $this->descritption;
    }

    /**
     * Set bail
     *
     * @param \Wise\CoreBundle\Entity\Bail $bail
     *
     * @return Document
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

    /**
     * Set property
     *
     * @param \Wise\CoreBundle\Entity\Property $property
     *
     * @return Document
     */
    public function setProperty(\Wise\CoreBundle\Entity\Property $property = null)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \Wise\CoreBundle\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }
}
