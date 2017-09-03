<?php

namespace Wise\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="Wise\CoreBundle\Repository\PropertyRepository")
 */
class Property
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
     * @ORM\ManyToOne(targetEntity="Wise\CoreBundle\Entity\Owner", inversedBy="property")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\Document", mappedBy="property", cascade={"persist"})
     */
    private $document;

    /**
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\Bail", mappedBy="property", cascade={"persist"})
     */
    private $bail;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="residence", type="string", length=255)
     */
    private $residence;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

    /**
     * Define the bail progress by calculating from date started and date ended.
     *
     * @var $bailDuration
     */
    private $bailDuration;


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
     * @return Property
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
     * Set residence
     *
     * @param string $residence
     *
     * @return Property
     */
    public function setResidence($residence)
    {
        $this->residence = $residence;

        return $this;
    }

    /**
     * Get residence
     *
     * @return string
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Property
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Property
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Property
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
     * Set bailDuration
     *
     * @param string $bailDuration
     *
     * @return Property
     */
    public function setBailDuration($bailDuration)
    {
        $this->bailDuration = $bailDuration;

        return $this;
    }

    /**
     * Get bailDuration
     *
     * @return string
     */
    public function getBailDuration()
    {
        return $this->bailDuration;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->document = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bail = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set owner
     *
     * @param \Wise\CoreBundle\Entity\Owner $owner
     *
     * @return Property
     */
    public function setOwner(\Wise\CoreBundle\Entity\Owner $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Wise\CoreBundle\Entity\Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add document
     *
     * @param \Wise\CoreBundle\Entity\Document $document
     *
     * @return Property
     */
    public function addDocument(\Wise\CoreBundle\Entity\Document $document)
    {
        $this->document[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Wise\CoreBundle\Entity\Document $document
     */
    public function removeDocument(\Wise\CoreBundle\Entity\Document $document)
    {
        $this->document->removeElement($document);
    }

    /**
     * Get document
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Add bail
     *
     * @param \Wise\CoreBundle\Entity\Bail $bail
     *
     * @return Property
     */
    public function addBail(\Wise\CoreBundle\Entity\Bail $bail)
    {
        $this->bail[] = $bail;

        return $this;
    }

    /**
     * Remove bail
     *
     * @param \Wise\CoreBundle\Entity\Bail $bail
     */
    public function removeBail(\Wise\CoreBundle\Entity\Bail $bail)
    {
        $this->bail->removeElement($bail);
    }

    /**
     * Get bail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBail()
    {
        return $this->bail;
    }
}
