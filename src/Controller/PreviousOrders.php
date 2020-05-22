<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;        
        
class PreviousOrders extends AbstractController
{
    /**
     * @Route("/PreviousOrders", name="preorders") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $id =$this->getUser()->getId();
        
        	$repository = $this->getDoctrine()->getRepository(Orders::class);
        	$orders = $repository->findBy(['user_id' => $id]);

       if($orders){
        echo '<h2>Previous Orders</h2>
        <br/>
        <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
                        <tr>
                            <th data-priority="1">Order id</th>
                            <th data-priority="2">Order</th>
                            <th data-priority="3">Delivery Address</th>
                            <th data-priority="4">Phone Number</th>
                            <th data-priority="5">Total Price</th>
                            <th data-priority="6">Order Status</th>
                        </tr>';
        foreach($orders as $obj)
        {
            echo    '<tr>
                        <td>'.$obj->getId().'</td>
                        <td >'.$obj->getOrderContents().'</td>
                        <td>'.$obj->getDelAddress().'</td>
                        <td>'.$obj->getPhoneNumber().'</td>
                        <td>'.$obj->getTotalPrice().'</td>
                        <td>'.$obj->getStatus().'</td>
                    </tr>';
        }
        echo '</table>';
        }
        else
        {
            echo '<p>No Previous Orders</p>';
        }
       
        return new Response('');
    }
}