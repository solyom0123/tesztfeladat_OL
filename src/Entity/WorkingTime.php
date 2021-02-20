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
    private $inHour;

    /**
     * @ORM\Column(type="float")
     */
    private $weekendBonus;

    /**
     * @ORM\ManyToOne(targetEntity=Worker::class, inversedBy="workingTimes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $worker_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    public function getInHour(): ?float
    {
        return $this->inHour;
    }

    public function setInHour(float $inHour): self
    {
        $this->inHour = $inHour;

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

    public function getWorkerId(): ?Worker
    {
        return $this->worker_id;
    }

    public function setWorkerId(?Worker $worker_id): self
    {
        $this->worker_id = $worker_id;

        return $this;
    }
}
