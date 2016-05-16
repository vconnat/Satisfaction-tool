<?php

namespace Ajax\SatisfactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Person Satisfaction Equilibrium Type
 *
 * @ORM\Table(name="ps_equilibrium_type")
 * @ORM\Entity(repositoryClass="Ajax\SatisfactionBundle\Repository\PSEquilibriumTypeRepository")
 */

class PSEquilibriumType
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
    private $equilibriumName;

    /**
     * @var text
     *
     * @ORM\Column(name="image_name", type="text")
     */
    private $equilibriumImageName;

    /**
     * @ORM\OneToMany(targetEntity="Ajax\SatisfactionBundle\Entity\PersonSatisfaction", mappedBy="psEquilibriumType", cascade={"persist", "remove"})
    */
    private $satisfactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->satisfactions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set equilibriumName
     *
     * @param string $equilibriumName
     *
     * @return PSEquilibriumType
     */
    public function setEquilibriumName($equilibriumName)
    {
        $this->equilibriumName = $equilibriumName;

        return $this;
    }

    /**
     * Get equilibriumName
     *
     * @return string
     */
    public function getEquilibriumName()
    {
        return $this->equilibriumName;
    }

    /**
     * Set equilibriumImageName
     *
     * @param string $equilibriumImageName
     *
     * @return PSEquilibriumType
     */
    public function setEquilibriumImageName($equilibriumImageName)
    {
        $this->equilibriumImageName = $equilibriumImageName;

        return $this;
    }

    /**
     * Get equilibriumImageName
     *
     * @return string
     */
    public function getEquilibriumImageName()
    {
        return $this->equilibriumImageName;
    }

    /**
     * Add satisfactions
     *
     * @param \Ajax\SatisfactionBundle\Entity\PersonSatisfaction
     *
     * @return PSEquilibriumType
     */
    public function addSatisfaction( \Ajax\SatisfactionBundle\Entity\PersonSatisfaction $satisfaction )
    {
        $this->satisfactions[] = $satisfaction;

        return $this;
    }

    /**
     * Remove satisfactions
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
