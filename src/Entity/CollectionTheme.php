<?php

namespace App\Entity;

use App\Repository\CollectionThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectionThemeRepository::class)
 */
class CollectionTheme
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
     * @ORM\OneToMany(targetEntity=OwnCollection::class, mappedBy="collectionTheme")
     */
    private $OwnCollection;

    public function __construct()
    {
        $this->OwnCollection = new ArrayCollection();
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

    /**
     * @return Collection|OwnCollection[]
     */
    public function getOwnCollection(): Collection
    {
        return $this->OwnCollection;
    }

    public function addOwnCollection(OwnCollection $ownCollection): self
    {
        if (!$this->OwnCollection->contains($ownCollection)) {
            $this->OwnCollection[] = $ownCollection;
            $ownCollection->setCollectionTheme($this);
        }

        return $this;
    }

    public function removeOwnCollection(OwnCollection $ownCollection): self
    {
        if ($this->OwnCollection->removeElement($ownCollection)) {
            // set the owning side to null (unless already changed)
            if ($ownCollection->getCollectionTheme() === $this) {
                $ownCollection->setCollectionTheme(null);
            }
        }

        return $this;
    }
}
