<?php

namespace App\Entity;

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
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     *
     */
    private $age;
    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     *
     */
    private $visible;
    /**
     * @var date
     *
     * @ORM\Column(name="created_at", type="date")
     *
     */
    private $createdAt;

    /**
     * Personne constructor.
     * @param int $id
     * @param string $name
     * @param int $age
     * @param bool $visible
     * @param date $createdAt
     */
    public function __construct($name, $age, $visible, \DateTime $createdAt)
    {
        $this->name = $name;
        $this->age = $age;
        $this->visible = $visible;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return boolean
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @return date
     */
    public function getCreatedAt(): date
    {
        return $this->createdAt;
    }



}