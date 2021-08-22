<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
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
     * @ORM\ManyToOne(targetEntity=OwnCollection::class, inversedBy="item")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ownCollection;

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

    public function getOwnCollection(): ?OwnCollection
    {
        return $this->ownCollection;
    }

    public function setOwnCollection(?OwnCollection $ownCollection): self
    {
        $this->ownCollection = $ownCollection;

        return $this;
    }

}
