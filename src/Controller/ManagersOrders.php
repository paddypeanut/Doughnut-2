<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Doctrine\ORM\Query\ResultSetMapping;
      
        
class ManagersOrders extends AbstractController
{
    /**
     * @Route("/ManagersOrders", name="managersoorders") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type = $request->request->get('type', 'order type');
        $entityManager = $this->getDoctrine()->getManager();
        
        $repository = $this->getDoctrine()->getRepository(Orders::class);
        if($type == 'progress')
        {
        	$orders = $repository->findBy(['status' => 'In Progress']);

            if($orders)
            {
                     echo '<h3>Order in progress.</h3><br><table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
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
                                        <td class="wide-col format-text ">'.$obj->getOrderContents().'</td>
                                        <td class="format-add-text wide-col">'.$obj->getDelAddress().'</td>
                                        <td>'.$obj->getPhoneNumber().'</td>
                                        <td>'.$obj->getTotalPrice().'</td>
                                        <td class="order-status">'.$obj->getStatus().'</td>
                                        <td><button class="cancel-order">Cancel Order</button></td>
                                    </tr>';
                        }
                        echo '</table><hr><span id="progress-count" class="hide">'.count($orders).'</span>';
            } 
            else
            {
            echo 'No orders in progress';
            }
        }

        else if($type == 'dispatched')
        {
            $orders = $repository->findBy(['status' => 'Dispatched']);

            if($orders)
            {
                 echo '<h3>Dispatched orders.</h3><br><table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
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
                            echo    '<tr class="single-order">
                                        <td class="order-id">'.$obj->getId().'</td>
                                        <td class="wide-col format-text ">'.$obj->getOrderContents().'</td>
                                        <td class="format-add-text wide-col">'.$obj->getDelAddress().'</td>
                                        <td>'.$obj->getPhoneNumber().'</td>
                                        <td>'.$obj->getTotalPrice().'</td>
                                        <td class="order-status">'.$obj->getStatus().'</td>
                                    </tr>';
                        }
                        echo '</table><hr><span id="dispatch-count" class="hide">'.count($orders).'</span>';
            }
            else
            {
                echo 'No orders out on Dispatch.';
            }
        }

        else if($type == 'complete')
        {
            $orders = $repository->findBy(['status' => 'Complete']);
            if($orders)
            {
                 echo '<h3>Complete orders.</h3><br><table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
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
                            echo    '<tr class="single-order">
                                        <td class="order-id">'.$obj->getId().'</td>
                                        <td class="wide-col format-text ">'.$obj->getOrderContents().'</td>
                                        <td class="format-add-text wide-col">'.$obj->getDelAddress().'</td>
                                        <td>'.$obj->getPhoneNumber().'</td>
                                        <td>'.$obj->getTotalPrice().'</td>
                                        <td class="order-status">'.$obj->getStatus().'</td>
                                    </tr>';
                        }
                        echo '</table><hr><span id="complete-count" class="hide">'.count($orders).'</span>';
            }
            else
            {
                echo 'No orders complete.';
            }
        }

        else if($type == 'cancel')
        {
            $cancelId = $request->request->get('id');
            $cancelOrder = $repository->findOneBy(['id' => $cancelId]);
            $entityManager->remove($cancelOrder);
            $entityManager->flush();
        }

        else if($type == 'filterdates')
        {
            $startDate = $request->request->get('start', 'start date');
            $endDate = $request->request->get('end','end date');

            
            $query = $entityManager->createQuery(
                "SELECT p
                                FROM App\Entity\Orders p
                                WHERE p.order_date
                                BETWEEN :startdate
                                AND :enddate"
                
            );
            $query->setParameter('startdate', $startDate);
            $query->setParameter('enddate',$endDate);    
            $orders = $query->getResult();

            if($orders)
            {
                 echo '<table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
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
                            echo    '<tr class="single-order">
                                        <td class="order-id">'.$obj->getId().'</td>
                                        <td class="wide-col format-text ">'.$obj->getOrderContents().'</td>
                                        <td class="format-add-text wide-col">'.$obj->getDelAddress().'</td>
                                        <td>'.$obj->getPhoneNumber().'</td>
                                        <td>'.$obj->getTotalPrice().'</td>
                                        <td class="order-status">'.$obj->getStatus().'</td>
                                    </tr>';
                        }
                        echo '</table>';
            }
            else
            {
                echo 'No orders in month range.';
            }

            

        }

        

        return new Response('');
    }
}