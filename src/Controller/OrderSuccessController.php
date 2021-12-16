<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Carrier;
use App\Entity\Order;
use App\Entity\Product;
use App\Service\Cart\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande/merci/{stripe_session_id}', name: 'order_success')]
    public function index($stripe_session_id,CartService $cart): Response
    {

        $order = $this->entityManager->getRepository(Order::class)->findOneBy(array('stripe_session_id'=>$stripe_session_id));

        if(!$order || $order->getUser() != $this->getUser()){
            return $this->redirectToRoute('home');
        }

        // Modifier le statut d'une commande
        if(!$order->getState() == 0){
            $cart->remove();

            $order->setState(1);
            $this->entityManager->flush();

            // envoi du mail confirmation de commande
            $mail = new Mail();
            $content = "Bonjour ".$order->getUser()->getFirstname()."<br/>Merci pour votre de commande";
            $mail->send($order->getUser()->getEmail(),$order->getUser()->getFirstname(),'Votre commande sur Papatte et patoune',$content);
        }
        return $this->render('order_status/success.html.twig',[
            'order' => $order,
        ]);
    }
}
