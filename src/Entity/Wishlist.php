<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\WishlistRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Doctrine\Common\Collections\Collection;
use App\Controller\WishlistAddProductController;
use Doctrine\Common\Collections\ArrayCollection;
use App\Controller\WishlistRemoveProductController;

#[ORM\Entity(repositoryClass: WishlistRepository::class)]
// #[ApiResource(
//     operations: [
//         new GetCollection(),
//         new Post(),
//         new Get(),
//         new Delete(),
//         new Patch(),
//         new Put(),
//         new Post(
//             uriTemplate: '/wishlists/{id}/add_product',
//             controller: WishlistAddProductController::class,
//             openapiContext: [
//                 'summary' => 'Ajouter un produit à la liste d\'envies',
//             ]
//         ),
//         new Delete(
//             uriTemplate: '/wishlists/{id}/remove_product',
//             controller: WishlistRemoveProductController::class,
//             openapiContext: [
//                 'summary' => 'Supprimer un produit de la liste d\'envies',
//             ]
//         ),
//     ]
// )]
#[ApiResource]
#[Broadcast]
class Wishlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'owner')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'products')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->products->removeElement($product);

        return $this;
    }
}
