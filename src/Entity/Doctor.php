<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Table(name="doctor")
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRepository")
 */
class Doctor
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $speciality;


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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSpeciality(): string
    {
        return $this->speciality;
    }

    /**
     * @param string $speciality
     */
    public function setSpeciality(string $speciality): void
    {
        $this->speciality = $speciality;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName()." ".$this->getSurname();
    }

}