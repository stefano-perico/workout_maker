<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MuscleGroupRepository")
 * @Vich\Uploadable()
 */
class MuscleGroup
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/png"
     * )
     * @Vich\UploadableField(mapping="muscle_group_image", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExercisesList", mappedBy="muscleGroup")
     */
    private $exercisesLists;

    public function __construct()
    {
        $this->exercisesLists = new ArrayCollection();
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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImage()
    {
        return 'images/muscle_group/'. $this->getImageName();
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return MuscleGroup
     */
    public function setImageFile(?File $imageFile): MuscleGroup
    {
        $this->imageFile = $imageFile;
        if ($imageFile instanceof UploadedFile){
            $this->setUpdatedAt(new \DateTime('now'));
        }
        return $this;
    }

    /**
     * @return Collection|ExercisesList[]
     */
    public function getExercisesLists(): Collection
    {
        return $this->exercisesLists;
    }

    public function addExercisesList(ExercisesList $exercisesList): self
    {
        if (!$this->exercisesLists->contains($exercisesList)) {
            $this->exercisesLists[] = $exercisesList;
            $exercisesList->setMuscleGroup($this);
        }

        return $this;
    }

    public function removeExercisesList(ExercisesList $exercisesList): self
    {
        if ($this->exercisesLists->contains($exercisesList)) {
            $this->exercisesLists->removeElement($exercisesList);
            // set the owning side to null (unless already changed)
            if ($exercisesList->getMuscleGroup() === $this) {
                $exercisesList->setMuscleGroup(null);
            }
        }

        return $this;
    }
}
