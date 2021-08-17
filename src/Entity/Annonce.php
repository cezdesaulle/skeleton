<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     */
    private $dateAvailable;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $hour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="annonce")
     */
    private $user;

    /**
     * @ORM\ManyToOne (targetEntity=SousService::class, inversedBy="annonce")
     */
    private $sousService;

    public function __construct()
    {

        $this->sousService = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDateAvailable(): ?\DateInterval
    {
        return $this->dateAvailable;
    }

    public function setDateAvailable(?\DateInterval $dateAvailable): self
    {
        $this->dateAvailable = $dateAvailable;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(?\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
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



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|SousService[]
     */
    public function getSousService(): Collection
    {
        return $this->sousService;
    }

    public function addSousService(SousService $sousService): self
    {
        if (!$this->sousService->contains($sousService)) {
            $this->sousService[] = $sousService;
            $sousService->setAnnonce($this);
        }

        return $this;
    }

    public function removeSousService(SousService $sousService): self
    {
        if ($this->sousService->removeElement($sousService)) {
            // set the owning side to null (unless already changed)
            if ($sousService->getAnnonce() === $this) {
                $sousService->setAnnonce(null);
            }
        }

        return $this;
    }
}
