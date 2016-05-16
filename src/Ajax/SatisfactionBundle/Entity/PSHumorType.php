<?php

namespace Ajax\SatisfactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Person Satisfaction Humor Type
 *
 * @ORM\Table(name="ps_humor_type")
 * @ORM\Entity(repositoryClass="Ajax\SatisfactionBundle\Repository\PSHumorTypeRepository")
 */
class PSHumorType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $humorName;

    /**
     * @var text
     *
     * @ORM\Column(name="image_name", type="text")
     */
    private $humorImageName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_irritant", type="boolean", nullable=false )
     */
    private $showIrritant;

    /**
     * @ORM\OneToMany(targetEntity="Ajax\SatisfactionBundle\Entity\PersonSatisfaction", mappedBy="psHumorType", cascade={"persist", "remove"})
    */
    private $satisfactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->satisfactions    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->showIrritant     = FALSE;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set humorName
     *
     * @param string $humorName
     *
     * @return PSHumorType
     */
    public function setHumorName($humorName)
    {
        $this->humorName = $humorName;

        return $this;
    }

    /**
     * Get humorName
     *
     * @return string
     */
    public function getHumorName()
    {
        return $this->humorName;
    }

    /**
     * Set humorImageName
     *
     * @param string $humorImageName
     *
     * @return PSHumorType
     */
    public function setHumorImageName($humorImageName)
    {
        $this->humorImageName = $humorImageName;

        return $this;
    }

    /**
     * Get humorImageName
     *
     * @return string
     */
    public function getHumorImageName()
    {
        return $this->humorImageName;
    }

    

    /**
     * Set showIrritant
     *
     * @param boolean $showIrritant
     * @return PersonSatisfaction
     */
    public function setShowIrritant( $showIrritant )
    {
        $this->showIrritant = $showIrritant;
        return $this;
    }

    /**
    * Get showIrritant
    *
    * @return boolean 
    */
    public function getShowIrritant()
    {
        return $this->showIrritant;
    }

    /**
     * Add satisfaction
     *
     * @param \Ajax\SatisfactionBundle\Entity\PersonSatisfaction
     *
     * @return PSHumorType
     */
    public function addSatisfaction( \Ajax\SatisfactionBundle\Entity\PersonSatisfaction $satisfaction )
    {
        $this->satisfactions[] = $satisfaction;

        return $this;
    }

    /**
     * Remove satisfaction
     *
     * @param \Ajax\SatisfactionBundle\Entity\PersonSatisfaction
     */
    public function removeSatisfaction( \Ajax\SatisfactionBundle\Entity\PersonSatisfaction $satisfaction )
    {
        $this->satisfactions->removeElement( $satisfaction );
    }

    /**
     * Get satisfactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSatisfactions()
    {
        return $this->satisfactions;
    }
}
