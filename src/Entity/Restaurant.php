<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $src_image;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurateur::class)
     */
    private $restaurateur_id;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="restaurant")
     */
    private $rating_id;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="restaurant")
     */
    private $avis_id;

    public function __construct()
    {   
        $this->rating_id = new ArrayCollection();
        $this->avis_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSrcImage(): ?string
    {
        return $this->src_image;
    }

    public function setSrcImage(?string $src_image): self
    {
        $this->src_image = $src_image;

        return $this;
    }

    public function getRestaurateurId(): ?Restaurateur
    {
        return $this->restaurateur_id;
    }

    public function setRestaurateurId(?Restaurateur $restaurateur_id): self
    {
        $this->restaurateur_id = $restaurateur_id;

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatingId(): Collection
    {
        return $this->rating_id;
    }

    public function addRatingId(Rating $ratingId): self
    {
        if (!$this->rating_id->contains($ratingId)) {
            $this->rating_id[] = $ratingId;
            $ratingId->setRestaurant($this);
        }

        return $this;
    }

    public function removeRatingId(Rating $ratingId): self
    {
        if ($this->rating_id->contains($ratingId)) {
            $this->rating_id->removeElement($ratingId);
            // set the owning side to null (unless already changed)
            if ($ratingId->getRestaurant() === $this) {
                $ratingId->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvisId(): Collection
    {
        return $this->avis_id;
    }

    public function addAvisId(Avis $avisId): self
    {
        if (!$this->avis_id->contains($avisId)) {
            $this->avis_id[] = $avisId;
            $avisId->setRestaurant($this);
        }

        return $this;
    }

    public function removeAvisId(Avis $avisId): self
    {
        if ($this->avis_id->contains($avisId)) {
            $this->avis_id->removeElement($avisId);
            // set the owning side to null (unless already changed)
            if ($avisId->getRestaurant() === $this) {
                $avisId->setRestaurant(null);
            }
        }

        return $this;
    }
}
