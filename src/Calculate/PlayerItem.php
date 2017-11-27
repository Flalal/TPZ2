<?php

namespace App\Calculate;

use App\Entity\Player;

class PlayerItem
{

    private $em;
    private $player;
    private $playerItem;

    /**
     *
     * PlayerItem constructor.
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function calcul(){


    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
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
     * @return mixed
     */
    public function getPlayerItem()
    {
        return $this->playerItem;
    }

    /**
     * @param mixed $playerItem
     */
    public function setPlayerItem($playerItem)
    {
        $this->playerItem = $playerItem;
    }


}