<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="client_id")
     */
    private $rating_id;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="client_id")
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
            $ratingId->setClientId($this);
        }

        return $this;
    }

    public function removeRatingId(Rating $ratingId): self
    {
        if ($this->rating_id->contains($ratingId)) {
            $this->rating_id->removeElement($ratingId);
            // set the owning side to null (unless already changed)
            if ($ratingId->getClientId() === $this) {
                $ratingId->setClientId(null);
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
            $avisId->setClientId($this);
        }

        return $this;
    }

    public function removeAvisId(Avis $avisId): self
    {
        if ($this->avis_id->contains($avisId)) {
            $this->avis_id->removeElement($avisId);
            // set the owning side to null (unless already changed)
            if ($avisId->getClientId() === $this) {
                $avisId->setClientId(null);
            }
        }

        return $this;
    }
}
