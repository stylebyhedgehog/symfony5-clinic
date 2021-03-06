<?php


namespace App\Resource;


use App\Entity\Schedule;
use App\Entity\Usr;

class ScheduleResource
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $usernameDoctor;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $cabinet;

    /**
     * @var string
     */
    private $date;

    /**
     * @var int
     */
    private $slots;

    /**
     * @return int
     */
    public function getId(): int
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
    public function getUsernameDoctor(): string
    {
        return $this->usernameDoctor;
    }

    /**
     * @param string $usernameDoctor
     */
    public function setUsernameDoctor(string $usernameDoctor): void
    {
        $this->usernameDoctor = $usernameDoctor;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getCabinet(): string
    {
        return $this->cabinet;
    }

    /**
     * @param string $cabinet
     */
    public function setCabinet(string $cabinet): void
    {
        $this->cabinet = $cabinet;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getSlots(): int
    {
        return $this->slots;
    }

    /**
     * @param int $slots
     */
    public function setSlots(int $slots): void
    {
        $this->slots = $slots;
    }

    public function toResource( Schedule $schedule, Usr $user){
        $this->setId($schedule->getId());
        $this->setUsernameDoctor($user->getUsername());
        $this->setRole($user->getRoles()[0]);
        $this->setDate($schedule->getDate()->format('Y-m-d H:i:s'));
        $this->setCabinet($schedule->getCabinet());
        $this->setSlots($schedule->getSlots());
    }
}