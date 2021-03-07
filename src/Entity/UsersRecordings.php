<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users_recordings")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRecordingsRepository")
 */
class UsersRecordings
{
    /**
     * @var int
     * * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Usr
     *
     * @ORM\ManyToOne(targetEntity="Usr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var Schedule
     *
     * @ORM\ManyToOne(targetEntity="Schedule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_schedule", referencedColumnName="id")
     * })
     */
    private $idSchedule;

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



}