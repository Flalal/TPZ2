<?php

namespace App\Calculate;
use App\Entity\Personne;

class Inventory
{

    private $em;
    private $personne;
    private $inventory;

    /**
     *
     * Inventory constructor.
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function calcul(){

       $poids = 0;
        foreach ($this->personne->getInventories() as $inv){
            $poids += $inv->getMaterial()->getWeight() * $inv->getNumberOfItem();
        }

        $poids += $this->inventory->getMaterial()->getWeight() * $this->inventory->getNumberOfItem();

        return $this->personne->getMaxWeight() >= $poids;
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
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * @param mixed $inventory
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;
    }


}