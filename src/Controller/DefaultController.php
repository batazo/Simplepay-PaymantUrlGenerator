<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;



class DefaultController  extends AbstractController
{
    public function __construct()
    {
        

    }

    #[Route('/', "home")]
    public function defaultAction(): Response
    {
        
        $summ = szor(50, 20);

        $items = [
            "product"=>"OK",
        ];

        return $this->render('default/home.html.twig', [
            'items'=>$items,
            'sum'=> $summ
        ]);
    }
}
