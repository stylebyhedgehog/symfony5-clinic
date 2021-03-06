<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalCartRepository")
 */
class MedicalCart
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Usr
     * One Product has One Shipment.
     * @OneToOne(targetEntity="Usr")
     * @JoinColumn(name="id_user",unique=true, referencedColumnName="id")
     */
    private $idUser;

    /**
     *  @var string
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
    private $passport;

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
    public function getPassport(): string
    {
        return $this->passport;
    }

    /**
     * @param string $passport
     */
    public function setPassport(string $passport): void
    {
        $this->passport = $passport;
    }


}