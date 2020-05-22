<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;        
        
class AllOrders extends AbstractController
{
    /**
     * @Route("/AvailableOrders", name="availableoorders") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        
        
        	$repository = $this->getDoctrine()->getRepository(Orders::class);
        	$orders = $repository->findBy(['status' => 'In Progress']);


        if($orders){
        echo '<table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
                        <tr>
                            <th data-priority="1">Order id</th>
                            <th data-priority="2">Order</th>
                            <th data-priority="3">Delivery Address</th>
                            <th data-priority="4">Phone Number</th>
                            <th data-priority="5">Total Price</th>
                            <th data-priority="6">Order Status</th>
                            <th></th>
                        </tr>';
        foreach($orders as $obj)
        {
            echo    '<tr class="single-order">
                        <td class="order-id">'.$obj->getId().'</td>
                        <td class="format-text wide-col">'.$obj->getOrderContents().'</td>
                        <td class="format-add-text wide-col">'.$obj->getDelAddress().'</td>
                        <td>'.$obj->getPhoneNumber().'</td>
                        <td>'.$obj->getTotalPrice().'</td>
                        <td class="order-status">'.$obj->getStatus().'</td>
                        <td><button class="collect-order">Collect</button></td>
                    </tr>';
        }
        echo '</table>';
    }
    else {
        echo 'No orders in progress';
    }

        return new Response('');
    }
}