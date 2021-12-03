<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @route("/accueil", name="home")
     */
    public function index(): Response

    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('home/index.html.twig',[
            'headers' => $headers
        ]);
    }
}
