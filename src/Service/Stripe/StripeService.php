<?php

namespace App\Service;

use DateTime;
use Stripe\Stripe;
use App\Entity\Order;
use Stripe\Checkout\Session;
use Symfony\Component\Form\Form;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeService
{

    public function __construct(private $em) {

    }


    public function getArrayResponse(
        array $cart, Form $form,
        Order $order, UrlGeneratorInterface $generator, string $key): string
    {
        $date = new DateTime();
        $reference = $date->format("dmY")."-".uniqid();
        $session = $this->getSession($cart, $form, $order, $generator, $key);
        $order->setReference($reference);
        $order->setStripeSessionId($session->id);

        $carriers = $form->get('carrier')->getData();
        $order->setCarrierName($carriers->getName());
        $order->setCarrierPrice($carriers->getPrice());

        $delivery = $form->get('adresse')->getData();
        $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
        $delivery_content .= '<br/>'.$delivery->getTelephone();
        $delivery_content .= '<br/>'.$delivery->getAdresse();
        $delivery_content .= '<br/>'.$delivery->getCp().' '.$delivery->getVille();
        $delivery_content .= '<br/>'.$delivery->getPays();
        $order->setDelivery($delivery_content);

        $this->em->persist($order);
        $this->em->flush();
        return $session->url;
    }

    public function checkSuccess(Order $order, string $key)
    {
        Stripe::setApiKey($key);
        $retrievedCheckout = Session::Retrieve($order->getStripeSessionId());
        if($retrievedCheckout->payment_status === 'paid')
        {
            $order->setState("complete");
            $this->em->persist($order);
            $this->em->flush();
            return true;
        }
        return false;
    }


    private function getSession(array $cart, Form $form, Order $order, UrlGeneratorInterface $generator, string $key): Session
    {

        Stripe::setApiKey($key);
        return Session::create([
            'customer_email' => $order->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [$this->getProductForStripe($cart, $form)],
            'mode' => 'payment',
            'success_url' =>$generator->generate('order_success',['id' => $order->getId()],UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $generator->generate('order_failed',['id' => $order->getId()],UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

    }

    private function getProductForStripe(array $cart, Form $form): array
    {
        $products_for_stripe = [];
        foreach ($cart as $product) {

            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product['product']->getPrice()*100,
                    'product_data' => [
                        'name' => $product['product']->getName()
                    ],
                ],
                'quantity' => $product['quantity']
            ];

        }
        $products_for_stripe[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $form['carrier']->getData()->getPrice()*100,
                'product_data' => [
                    'name' => $form['carrier']->getData()->getName()
                ],
            ],
            'quantity' => 1
        ];

        return $products_for_stripe;
    }

}
