<?php

namespace Sab\SatisfactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stf_equilibrium
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Stf_equilibrium
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
     *
     * @var String
     * @ORM\Column(name="label", type="string")
     */
    private $label;
    
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
     * Set label
     *
     * @param string $label
     *
     * @return Stf_equilibrium
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
