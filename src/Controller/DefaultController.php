<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Traits\Test\Exponentiation;

class DefaultController  extends AbstractController
{
    use Exponentiation;
    public function __construct()
    {
        

    }

    #[Route('/', "home")]
    public function defaultAction(): Response
    {
        $items = [
            "product"=>"OK",
        ];

        $ref = uniqid(true);

        return $this->render('default/home.html.twig', [
            'items'=>$items,
            'ref'=> $ref
        ]);
    }
}
