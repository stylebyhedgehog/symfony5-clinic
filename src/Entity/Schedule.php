<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Schedule
 * @ORM\Table(name="schedule")
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_doctor", type="integer", nullable=false)
     */
    private $idDoctor;

    /**
     * @var string
     *
     * @ORM\Column(name="cabinet", type="string", length=10, nullable=false)
     */
    private $cabinet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="slots", type="integer", nullable=false)
     */
    private $slots;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDoctor(): ?int
    {
        return $this->idDoctor;
    }

    public function setIdDoctor(int $idDoctor): self
    {
        $this->idDoctor = $idDoctor;

        return $this;
    }

    public function getCabinet(): ?string
    {
        return $this->cabinet;
    }

    public function setCabinet(string $cabinet): self
    {
        $this->cabinet = $cabinet;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSlots(): ?int
    {
        return $this->slots;
    }

    public function setSlots(int $slots): self
    {
        $this->slots = $slots;

        return $this;
    }

//    /**
//     * @return Collection|Usr[]
//     */
//    public function getIdUser(): Collection
//    {
//        return $this->idUser;
//    }
//
//    public function addIdUser(Users $idUser): self
//    {
//        if (!$this->idUser->contains($idUser)) {
//            $this->idUser[] = $idUser;
//            $idUser->addIdSchedule($this);
//        }
//
//        return $this;
//    }
//
//    public function removeIdUser(Users $idUser): self
//    {
//        if ($this->idUser->removeElement($idUser)) {
//            $idUser->removeIdSchedule($this);
//        }
//
//        return $this;
//    }


}
