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

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $job;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $policy;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $insurance_program;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $type;
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

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    public function setPolicy(string $policy): self
    {
        $this->policy = $policy;

        return $this;
    }


    public function getInsuranceProgram(): ?string
    {
        return $this->insurance_program;
    }

    public function setInsuranceProgram(string $insurance_program): self
    {
        $this->insurance_program = $insurance_program;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}