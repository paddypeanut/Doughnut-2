<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;        
        
class DatabaseData extends AbstractController
{
    /**
     * @Route("/DatabaseData", name="Data") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        
        	$repository = $this->getDoctrine()->getRepository(Products::class);
        	$products = $repository->findAll();

        	echo '<table data-role="table" id="movie-table" data-mode="reflow" class="movei-list ui-responsive width-100">
      					<tr>
      						<th data-priority="1">Product</th>
                            <th></th>
     						<th data-priority="2">Quantity</th>
                            <th></th>
      						<th data-priority="3">Price</th>
      						<th data-priority="4">Total Price</th>
      					</tr>';
        foreach($products as $obj)
        {
            echo 		'<tr>
        					<td class="p-title">'.$obj->getPTitle().'</td>
        					<td>
        						<button class="min ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-btn-icon-notext  ui-icon-minus">minus</button>
        					</td>
        					<td>
        						<input min="0" class="qty-box" type="text" size="2" value="0">
        					</td>
        					<td>
        						<button class="plus ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-btn-icon-notext  ui-icon-plus">plus</button>
        					</td>
        					<td class="price" value="'.$obj->getPPrice().'">€'.$obj->getPPrice().'</td>
        					<td>
        						<input type="text" value="0" class="total-price" size="2">
        					</td>
        				</tr>';
        }
        echo '</table>
        		<br>Total Price : <input type="text" size="3" id="total-sum" value="0">';

        return new Response();
    }
}