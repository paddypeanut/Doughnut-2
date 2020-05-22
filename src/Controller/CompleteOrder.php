<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Products;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Session\Session;       
        
class CompleteOrder extends AbstractController
{
    /**
     * @Route("/CompleteOrder", name="completeorder") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        $id = $this->getUser()->getId();
        $completeOrder = $request->request->get('order','order');
        $address = $request->request->get('add','address');
        $total = $request->request->get('total','total');
        $phone = $request->request->get('ph', 'Phone Number');


          
         $entityManager = $this->getDoctrine()->getManager();

                
                $order = new Orders();
        
                $order->setUserId($id);
                $order->setOrderContents($completeOrder);
                $order->setTotalPrice($total);
                $order->setStatus('In Progress');
                $order->setDelAddress($address);
                $order->setPhoneNumber($phone);
                $order->setDeliveredBy('0');
                $order->setOrderDate(date("m"));

                $entityManager->persist($order);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
  
        

        

        
       
        return new Response( 'order added');


    }
}