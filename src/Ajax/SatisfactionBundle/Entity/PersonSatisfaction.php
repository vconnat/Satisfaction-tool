<?php

namespace Ajax\SatisfactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Ajax\SatisfactionBundle\Entity\PSHumorType;
use Ajax\SatisfactionBundle\Entity\PSEquilibriumType;

/**
 * PersonSatisfaction entity
 *
 * @ORM\Table(name="person_satisfaction")
 * @ORM\Entity(repositoryClass="Ajax\SatisfactionBundle\Repository\PersonSatisfactionRepository")
 */
class PersonSatisfaction
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Ajax\SatisfactionBundle\Entity\PSHumorType", inversedBy="satisfactions")
     * @ORM\JoinColumn(name="ps_humor_id", nullable=false )
     */
    private $psHumorType;

    /**
     * @var string
     *
     * @ORM\Column(name="main_irritant", type="text", nullable=true )
     */
    private $mainIrritant;

    /**
     * @ORM\ManyToOne(targetEntity="Ajax\SatisfactionBundle\Entity\PSEquilibriumType", inversedBy="satisfactions")
     * @ORM\JoinColumn(name="ps_equilibrium_id", nullable=false )
     */
    private $psEquilibriumType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="availability_manager", type="boolean", nullable=false )
     */
    private $availabilityManager;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false )
     */
    private $createdAt;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return PersonSatisfaction
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set month
     *
     * @param integer $month
     * @return PersonSatisfaction
     */
    public function setMonth( $month )
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer 
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return PersonSatisfaction
     */
    public function setYear( $year )
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get psHumorType
     *
     * @return Ajax\SatisfactionBundle\Entity\PSHumorType
     */
    public function getPsHumorType()
    {
        return $this->psHumorType;
    }

    /**
     * Set psHumorType
     *
     * @param Ajax\SatisfactionBundle\Entity\PSHumorType $psHumorType
     * @return PersonSatisfaction
     */
    public function setPsHumorType( \Ajax\SatisfactionBundle\Entity\PSHumorType $psHumorType )
    {
        $this->psHumorType = $psHumorType;

        return $this;
    }

    /**
     * Get mainIrritant
     *
     * @return string 
     */
    public function getMainIrritant()
    {
        return $this->mainIrritant;
    }

    /**
     * Set mainIrritant
     *
     * @param string $mainIrritant
     * @return PersonSatisfaction
     */
    public function setMainIrritant( $mainIrritant )
    {
        $this->mainIrritant = $mainIrritant;

        return $this;
    }

    /**
     * Get psEquilibriumType
     *
     * @return Ajax\SatisfactionBundle\Entity\PSEquilibriumType
     */
    public function getPsEquilibriumType()
    {
        return $this->psEquilibriumType;
    }

    /**
     * Set psEquilibriumType
     *
     * @param Ajax\SatisfactionBundle\Entity\PSEquilibriumType $psEquilibriumType
     * @return PersonSatisfaction
     */
    public function setPsEquilibriumType( \Ajax\SatisfactionBundle\Entity\PSEquilibriumType $psEquilibriumType )
    {
        $this->psEquilibriumType = $psEquilibriumType;

        return $this;
    }

    /**
     * Set availabilityManager
     *
     * @param boolean $availabilityManager
     * @return PersonSatisfaction
     */
    public function setAvailabilityManager( $availabilityManager )
    {
        $mgrAvailable = TRUE;
        if( (int) $availabilityManager == 0 ){
            $mgrAvailable = FALSE;
        }
        $this->availabilityManager = $mgrAvailable;

        return $this;
    }

    /**
     * Get availabilityManager
     *
     * @return boolean 
     */
    public function getAvailabilityManager()
    {
        return (int) $this->availabilityManager;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Account
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
