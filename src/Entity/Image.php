<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $src;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $alt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="image")
     * @ORM\Column(nullable=true)
     */
    private $programs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Workout", mappedBy="image")
     * @ORM\Column(nullable=true)
     */
    private $workouts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $base64Encode;


    public function __construct()
    {
        $this->programs = new ArrayCollection();
        $this->workouts = new ArrayCollection();
        $this->exercises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = base64_encode($src);

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setImage($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)) {
            $this->programs->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getImage() === $this) {
                $program->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Workout[]
     */
    public function getWorkouts(): Collection
    {
        return $this->workouts;
    }

    public function addWorkout(Workout $workout): self
    {
        if (!$this->workouts->contains($workout)) {
            $this->workouts[] = $workout;
            $workout->setImage($this);
        }

        return $this;
    }

    public function removeWorkout(Workout $workout): self
    {
        if ($this->workouts->contains($workout)) {
            $this->workouts->removeElement($workout);
            // set the owning side to null (unless already changed)
            if ($workout->getImage() === $this) {
                $workout->setImage(null);
            }
        }

        return $this;
    }

    public function getBase64Encode(): ?string
    {
        return base64_decode($this->base64Encode);
    }

    public function setBase64Encode(string $base64Encode): self
    {
        $data = base64_encode(file_get_contents($_FILES[$base64Encode]));
        $this->base64Encode = $base64Encode;

        return $this;
    }

}
