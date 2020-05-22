<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Products;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Session\Session;       
        
class GetUserId extends AbstractController
{
    /**
     * @Route("/GetUserId", name="getid") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        $name = $request->request->get('un', 'username');
          
        $repository = $this->getDoctrine()->getRepository(Users::class);
  
        $user = $repository->findOneBy(['username' => $name]);

        $id = $user->getId();

        if($id){
            return new Response(
                $id
        );     
        }
       
        return new Response( );


    }
}