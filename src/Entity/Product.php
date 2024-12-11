<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource()]
#[Broadcast]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?int $id = null;

     /**
     * @Assert\NotBlank(message="Le code est obligatoire.")
     * @Assert\Length(max=50, maxMessage="Le code ne peut pas dépasser 50 caractères.")
     */
    #[ORM\Column(length: 255)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]

    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]

    private ?string $category = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?int $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?string $internalReference = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?int $shellId = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    #[Assert\Choice(choices: ['INSTOCK', 'LOWSTOCK', 'OUTOFSTOCK'], message: 'Le statut doit être "INSTOCK", "LOWSTOCK" ou "OUTOFSTOCK".')]
    private ?string $inventoryStatus = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'cart_item:read'])]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\ManyToMany(targetEntity: Wishlist::class, mappedBy: 'products')]
    private Collection $products;



    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInternalReference(): ?string
    {
        return $this->internalReference;
    }

    public function setInternalReference(?string $internalReference): static
    {
        $this->internalReference = $internalReference;

        return $this;
    }

    public function getShellId(): ?int
    {
        return $this->shellId;
    }

    public function setShellId(?int $shellId): static
    {
        $this->shellId = $shellId;

        return $this;
    }

    public function getInventoryStatus(): ?string
    {
        return $this->inventoryStatus;
    }

    public function setInventoryStatus(?string $inventoryStatus): static
    {
        $this->inventoryStatus = $inventoryStatus;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    // public function getProduct(): ?string
    // {
    //     return $this->product;
    // }

    // public function setProduct(?string $product): self
    // {
    //     $this->product = $product;
    //     return $this;
    // }

    /**
     * @return Collection<int, Wishlist>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Wishlist $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addProduct($this);
        }

        return $this;
    }

    public function removeProduct(Wishlist $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeProduct($this);
        }

        return $this;
    }

}
