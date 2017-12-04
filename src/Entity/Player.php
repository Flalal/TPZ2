<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 * @UniqueEntity(fields="name", message="Hey, choose another one !")
 */
class Player
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
     * @ORM\Column()
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type("alpha")
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 18,
     *      max = 99,
     *      minMessage = "Min age : {{ limit }}",
     *      maxMessage = "Max age : { limit }}"
     * )
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column()
     * @Assert\NotBlank()
     * @Assert\Choice({"France", "Belgique"})
     */
    private $country;



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

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }




    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId() . " " . $this->getName() . " " . $this->age . " " . $this->getCountry();
    }


}