<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkerRepository::class)
 */
class Worker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity=WorkingTime::class, mappedBy="worker_id", orphanRemoval=true)
     */
    private $workingTimes;

    public function __construct()
    {
        $this->workingTimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection|WorkingTime[]
     */
    public function getWorkingTimes(): Collection
    {
        return $this->workingTimes;
    }

    public function addWorkingTime(WorkingTime $workingTime): self
    {
        if (!$this->workingTimes->contains($workingTime)) {
            $this->workingTimes[] = $workingTime;
            $workingTime->setWorkerId($this);
        }

        return $this;
    }

    public function removeWorkingTime(WorkingTime $workingTime): self
    {
        if ($this->workingTimes->removeElement($workingTime)) {
            // set the owning side to null (unless already changed)
            if ($workingTime->getWorkerId() === $this) {
                $workingTime->setWorkerId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
