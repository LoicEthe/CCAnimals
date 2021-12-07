<?php

namespace App\Controller;

use App\Classe\SearchSub;
use App\Entity\Product;
use App\Form\DogFormType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/produits/chien', name: 'product_chien')]
    public function dog(Request $request): Response
    {


        $product = $this->entityManager->getRepository(Product::class)->findWithCategoryDog();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/dog.html.twig',[
            'products' => $product,
        ]);
    }

    #[Route('/produits/chien/accessoires', name: 'accessoires_chien')]
    public function acc(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCat1();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/subcateg/accessoires.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chien/alimentation', name: 'alim_chien')]
    public function alimentation(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCat4();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/subcateg/alim.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chien/jouets', name: 'jouet_chien')]
    public function jouets(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCat3();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/subcateg/jouets.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chien/soins', name: 'soins_chien')]
    public function soins(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCat2();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/subcateg/soins.html.twig',[
            'products' => $product
        ]);
    }

    #[Route('/produits/chien/voyage', name: 'voyage_chien')]
    public function voy(): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findWithSubCat5();
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/dog/subcateg/voyage.html.twig',[
            'products' => $product
        ]);
    }
}