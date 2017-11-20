<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 14:01
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="inventory")
 */
class Inventory
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
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="inventories")
     * @ORM\JoinColumn(name="personne_id", referencedColumnName="id")
     *
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="Material")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     *
     */
    private $material;

    /**
     * @var
     * @ORM\Column(name="number_of_item", type="integer")
     */
    private $numberOfItem;


    public function __construct()
    {
        $this->material = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param mixed $personne
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }

    /**
     * @return mixed
     */
    public function getNumberOfItem()
    {
        return $this->numberOfItem;
    }

    /**
     * @param mixed $numberOfItem
     */
    public function setNumberOfItem($numberOfItem)
    {
        $this->numberOfItem = $numberOfItem;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getPersonne() . " " . $this->getMaterial() . " " . $this->getNumberOfItem(). PHP_EOL;
    }


}