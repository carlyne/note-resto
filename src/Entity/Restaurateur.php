<?php

namespace App\Entity;

use App\Repository\RestaurateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurateurRepository::class)
 */
class Restaurateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $last_name;

    /**
     * @ORM\Column(type="text")
     */
    private $first_name;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class, inversedBy="restaurateur_id")
     */
    private $restaurant_id;

    public function __construct()
    {
        $this->restaurant_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $lastName): self
    {
        $this->last_name = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurantId(): Collection
    {
        return $this->restaurant_id;
    }

    public function addRestaurantId(Restaurant $restaurantId): self
    {
        if (!$this->restaurant_id->contains($restaurantId)) {
            $this->restaurant_id[] = $restaurantId;
        }

        return $this;
    }

    public function removeRestaurantId(Restaurant $restaurantId): self
    {
        if ($this->restaurant_id->contains($restaurantId)) {
            $this->restaurant_id->removeElement($restaurantId);
        }

        return $this;
    }
}
