<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_appointments")
 * @ORM\Entity(repositoryClass="App\Repository\UserAppointmentsRepository")
 */
class UserAppointments
{
    /**
     * @var int
     * * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Usr|string
     *
     * @ORM\ManyToOne(targetEntity="Usr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $idUser;

    /**
     * @var Schedule|string
     *
     * @ORM\ManyToOne(targetEntity="Schedule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_schedule", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $idSchedule;

    /**
     * @var string
     * @ORM\Column (name="status",type="string", length=15, nullable=false)
     */
    private $status;

    public function getIdUser(): ?Usr
    {
        return $this->idUser;
    }

    public function setIdUser(?Usr $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdSchedule(): ?Schedule
    {
        return $this->idSchedule;
    }

    public function setIdSchedule(?Schedule $idSchedule): self
    {
        $this->idSchedule = $idSchedule;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

//TODO возможность использовать разные типы оплаты (в заявки)

}