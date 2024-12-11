<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Wishlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistAddProductController
{
    public function __invoke(Wishlist $wishlist, Request $request, EntityManagerInterface $em): Wishlist
    {
        $data = json_decode($request->getContent(), true);
        $productId = $data['productId'] ?? null;

        if (!$productId) {
            throw new \InvalidArgumentException('Product ID is required.');
        }

        $product = $em->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw new \InvalidArgumentException('Product not found.');
        }

        $wishlist->addProduct($product);
        $em->flush();

        return $wishlist;
    }
}
