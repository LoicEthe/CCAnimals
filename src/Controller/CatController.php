<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/produits/chat', name: 'product_chat')]
    public function cat(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithCategoryCat();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/cat.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/cat/accessoires', name: 'accessoires_chat')]
    public function acc(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCateg1();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/subcateg/accessoires.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/cat/alimentation', name: 'alim_chat')]
    public function alimentation(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCateg4();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/subcateg/alim.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chat/jouets', name: 'jouet_chat')]
    public function jouets(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCateg3();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/subcateg/jouets.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chat/soins', name: 'soins_chat')]
    public function soins(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCateg2();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/subcateg/soins.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chat/voyage', name: 'voyage_chat')]
    public function voy(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCateg5();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/cat/subcateg/voyage.html.twig',[
            'products' => $product
        ]);
    }
}
