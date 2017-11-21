<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="personnes")
 */
class Personne
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="max_weight", type="decimal", precision=4, scale=1)
     *
     */
    private $maxWeight;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param string $maxWeight
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
    }


    /**
     * @var Inventory[]
     * @ORM\OneToMany(targetEntity="Inventory", mappedBy="personne")
     */
    private $inventories;


    public function __construct()
    {
        $this->inventories = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Inventory[]
     */
    public function getInventories()
    {
        return $this->inventories;
    }

    /**
     * @param Inventory[] $inventories
     */
    public function setInventories($inventories)
    {
        $this->inventories = $inventories;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName() . " " . $this->getMaxWeight() . PHP_EOL;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }



}