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
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_items")
 */
class PlayerItem
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
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     *
     */
    private $player;

    /**
     * @var Item
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     *
     */
    private $item;


    /**
     * @var integer
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var Date
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * PlayerItem constructor.
     * @param $player
     * @param Item $item
     */
    public function __construct()
    {
        $this->player = new ArrayCollection();
        $this->item = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return Date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param Date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId() . " " . $this->getItem() . " " . $this->getPosition();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


}