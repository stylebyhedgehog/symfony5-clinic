<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorDataRepository")
 */
class DoctorData
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Usr
     * @OneToOne(targetEntity="Usr")
     * @JoinColumn(name="id_user", unique=true, referencedColumnName="id")
     */
    private $idUser;

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

    public function getIdUser(): ?Usr
    {
        return $this->idUser;
    }

    public function setIdUser(?Usr $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Usr
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Usr $id
     */
    public function setId(Usr $id): void
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


}