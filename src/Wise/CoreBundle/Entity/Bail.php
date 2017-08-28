<?php

namespace Wise\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Wise\CoreBundle\Entity\Document as Document;

/**
 * Bail
 *
 * @ORM\Table(name="bail")
 * @ORM\Entity(repositoryClass="Wise\CoreBundle\Repository\BailRepository")
 */
class Bail
{

    const LOCATION_VIDE   = 0;
    const LOCATION_MEUBLE = 1;
    const AUTRE_TYPE      = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="bail", cascade={"all"})
     */
    private $document;

    /**
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\Tenant", mappedBy="bail", cascade={"all"})
     */
    private $tenant;

    /**
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\InterventionRequest", mappedBy="bail", cascade={"all"})
     */
    private $interventionRequest;

    /**
     * @ORM\ManyToOne(targetEntity="Wise\CoreBundle\Entity\Property", cascade={"persist"})
     */
    private $property;

    /**
     * @var int
     *
     * @ORM\Column(name="loyer", type="integer")
     */
    private $loyer;

    /**
     * @var bool
     *
     * @ORM\Column(name="meuble", type="boolean")
     */
    private $meuble;

    /**
     * @var int
     *
     * @ORM\Column(name="caution", type="integer")
     */
    private $caution;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_bail_ended", type="datetime", nullable=true)
     */
    private $dateBailEnded;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

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
     * Set loyer
     *
     * @param integer $loyer
     *
     * @return Bail
     */
    public function setLoyer($loyer)
    {
        $this->loyer = $loyer;

        return $this;
    }

    /**
     * Get loyer
     *
     * @return int
     */
    public function getLoyer()
    {
        return $this->loyer;
    }

    /**
     * Set meuble
     *
     * @param boolean $meuble
     *
     * @return Bail
     */
    public function setMeuble($meuble)
    {
        $this->meuble = $meuble;

        return $this;
    }

    /**
     * Get meuble
     *
     * @return bool
     */
    public function getMeuble()
    {
        return $this->meuble;
    }

    /**
     * Set caution
     *
     * @param integer $caution
     *
     * @return Bail
     */
    public function setCaution($caution)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution
     *
     * @return int
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Bail
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateBailEnded
     *
     * @param \DateTime $dateBailEnded
     *
     * @return Bail
     */
    public function setDateBailEnded($dateBailEnded)
    {
        $this->dateBailEnded = $dateBailEnded;

        return $this;
    }

    /**
     * Get dateBailEnded
     *
     * @return \DateTime
     */
    public function getDateBailEnded()
    {
        return $this->dateBailEnded;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Bail
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Bail
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return bool
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set property
     *
     * @param \Wise\CoreBundle\Entity\Property $property
     *
     * @return Bail
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
