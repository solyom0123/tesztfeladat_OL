<?php

namespace App\Entity;

use App\Repository\WorkingTimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkingTimeRepository::class)
 */
class WorkingTime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $start;

    /**
     * @ORM\Column(type="time")
     */
    private $end;

    /**
     * @ORM\Column(type="float")
     */
    private $workingHours;

    /**
     * @ORM\ManyToOne(targetEntity=worker::class, inversedBy="workingTimes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workerId;

    /**
     * @ORM\Column(type="float")
     */
    private $weekendBonus;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getWorkingHours(): ?float
    {
        return $this->workingHours;
    }

    public function setWorkingHours(float $workingHours): self
    {
        $this->workingHours = $workingHours;

        return $this;
    }

    public function getWorkerId(): ?worker
    {
        return $this->workerId;
    }

    public function setWorkerId(?worker $workerId): self
    {
        $this->workerId = $workerId;

        return $this;
    }

    public function getWeekendBonus(): ?float
    {
        return $this->weekendBonus;
    }

    public function setWeekendBonus(float $weekendBonus): self
    {
        $this->weekendBonus = $weekendBonus;

        return $this;
    }
}
