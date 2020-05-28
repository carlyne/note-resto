<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurateur::class, mappedBy="restaurant_id")
     */
    private $restaurateur_id;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="restaurant_id", orphanRemoval=true)
     */
    private $avis_id;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="restaurant_id", orphanRemoval=true)
     */
    private $rating_id;

    public function __construct()
    {
        $this->restaurateur_id = new ArrayCollection();
        $this->avis_id = new ArrayCollection();
        $this->rating_id = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Restaurateur[]
     */
    public function getRestaurateurId(): Collection
    {
        return $this->restaurateur_id;
    }

    public function addRestaurateurId(Restaurateur $restaurateurId): self
    {
        if (!$this->restaurateur_id->contains($restaurateurId)) {
            $this->restaurateur_id[] = $restaurateurId;
            $restaurateurId->addRestaurantId($this);
        }

        return $this;
    }

    public function removeRestaurateurId(Restaurateur $restaurateurId): self
    {
        if ($this->restaurateur_id->contains($restaurateurId)) {
            $this->restaurateur_id->removeElement($restaurateurId);
            $restaurateurId->removeRestaurantId($this);
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
            $avisId->setRestaurantId($this);
        }

        return $this;
    }

    public function removeAvisId(Avis $avisId): self
    {
        if ($this->avis_id->contains($avisId)) {
            $this->avis_id->removeElement($avisId);
            // set the owning side to null (unless already changed)
            if ($avisId->getRestaurantId() === $this) {
                $avisId->setRestaurantId(null);
            }
        }

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
            $ratingId->setRestaurantId($this);
        }

        return $this;
    }

    public function removeRatingId(Rating $ratingId): self
    {
        if ($this->rating_id->contains($ratingId)) {
            $this->rating_id->removeElement($ratingId);
            // set the owning side to null (unless already changed)
            if ($ratingId->getRestaurantId() === $this) {
                $ratingId->setRestaurantId(null);
            }
        }

        return $this;
    }
}
