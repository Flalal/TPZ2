<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 */
class Item
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
     * @ORM\Column(name="type_item", type="string", length=255)
     */
    private $typeItem;

    /**
     * @return string
     */
    public function getTypeItem()
    {
        return $this->typeItem;
    }

    /**
     * @param string $typeItem
     */
    public function setTypeItem($typeItem)
    {
        $this->typeItem = $typeItem;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId() . " " . $this->getName() . " ";
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}