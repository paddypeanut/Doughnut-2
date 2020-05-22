<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
    	 if($this->isGranted("ROLE_MANAGER"))
    	 	{
                return $this->redirectToRoute("manager");
            }
         elseif($this->isGranted("ROLE_CUSTOMER")){
         	return $this->redirectToRoute("customer");
         }
         elseif($this->isGranted("ROLE_DRIVER")){
         	return $this->redirectToRoute("driver");
         }
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
