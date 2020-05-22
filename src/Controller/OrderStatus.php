<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;        
        
class OrderStatus extends AbstractController
{
    /**
     * @Route("/OrderStatus", name="orderstatus") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type =$request->request->get('type', 'type');
        $id = $request->request->get('orderid', 'order id');
        $userId = $this->getUser()->getId();

        $entityManager = $this->getDoctrine()->getManager();
        
        $repository = $this->getDoctrine()->getRepository(Orders::class);
        $order = $repository->findOneBy(['id' => $id]);

        if($type == 'collect'){
            $order->setStatus('Dispatched');
            $order->setDeliveredBy($userId);
            $entityManager->flush();
        }
        if($type == 'delivered'){
            $order->setStatus('Complete');
            $entityManager->flush();
        }
        


        return new Response();
    }
}