<?php

namespace Wise\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Owner
 *
 * @ORM\Table(name="owner")
 * @ORM\Entity(repositoryClass="Wise\CoreBundle\Repository\OwnerRepository")
 */
class Owner
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
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\Property", mappedBy="owner", cascade={"all"})
     */
    private $property;

    /**
     * @ORM\OneToMany(targetEntity="Wise\CoreBundle\Entity\Event", mappedBy="owner", cascade={"persist"})
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=true, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Owner
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Owner
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Owner
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Owner
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->property = new \Doctrine\Common\Collections\ArrayCollection();
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add property
     *
     * @param \Wise\CoreBundle\Entity\Property $property
     *
     * @return Owner
     */
    public function addProperty(\Wise\CoreBundle\Entity\Property $property)
    {
        $this->property[] = $property;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \Wise\CoreBundle\Entity\Property $property
     */
    public function removeProperty(\Wise\CoreBundle\Entity\Property $property)
    {
        $this->property->removeElement($property);
    }

    /**
     * Get property
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Add event
     *
     * @param \Wise\CoreBundle\Entity\Event $event
     *
     * @return Owner
     */
    public function addEvent(\Wise\CoreBundle\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Wise\CoreBundle\Entity\Event $event
     */
    public function removeEvent(\Wise\CoreBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvent()
    {
        return $this->event;
    }
}
