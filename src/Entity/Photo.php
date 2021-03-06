<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @Vich\Uploadable()
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     *
     * @Vich\UploadableField(mapping="photo_images", fileNameProperty="image")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="photos")
     */
    private $admin;

    /**
     * @ORM\ManyToOne(targetEntity=AlbumPhoto::class, inversedBy="photos")
     * @ORM\JoinColumn(name="album_photo_id", referencedColumnName="id", nullable=true)
     */
    private $albumPhoto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $updatedAt = new \DateTimeImmutable();
        }
    }



//    public function setImageName(?string $imageName): void
//    {
//        $this->imageName = $imageName;
//    }
//
//    public function getImageName(): ?string
//    {
//        return $this->imageName;
//    }

//    public function __toString(): string
//    {
//        return $this->description;
//
//    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getAlbumPhoto(): ?AlbumPhoto
    {
        return $this->albumPhoto;
    }

    public function setAlbumPhoto(?AlbumPhoto $albumPhoto): self
    {
        $this->albumPhoto = $albumPhoto;

        return $this;
    }

//    public function __toString(): string
//    {
//        return $this->nom;
//
//    }

    public function __toString()
    {
        return (string)$this->nom;
    }
}
