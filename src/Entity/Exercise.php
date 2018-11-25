<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseRepository")
 */
class Exercise
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    private $reps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workout", inversedBy="exercises")
     */
    private $workout;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ExercisesList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exerciseName;

    public function __construct()
    {
        $this->workouts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReps(): ?int
    {
        return $this->reps;
    }

    public function setReps(int $reps): self
    {
        $this->reps = $reps;

        return $this;
    }

    public function getWorkout(): ?Workout
    {
        return $this->workout;
    }

    public function setWorkout(?Workout $workout): self
    {
        $this->workout = $workout;

        return $this;
    }

    public function getExerciseName(): ?ExercisesList
    {
        return $this->exerciseName;
    }

    public function setExerciseName(ExercisesList $exerciseName): self
    {
        $this->exerciseName = $exerciseName;

        return $this;
    }

}
