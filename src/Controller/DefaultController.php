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

        $items = [
            "product"=>"OK"
        ];

        return $this->render('default/home.html.twig', [
            'items'=>$items,
        ]);
    }

    #[Route('/default-json', "default-json")]
    public function tesztJsonAction(): JsonResponse
    {
        (array)$data = ['message'=>'OK'];

        return new JsonResponse($data);
    }

    #[Route('/default-render', "default-render")]
    public function defaultRenderAction(Request $request): Response
    {
        $env_var = $_ENV['TESZT_ENV'];
    
        return $this->render('default/defaultrender.html.twig', [
            'welcome'=>'Hello W',
            'env_var'=>$env_var
        ]);
    }


}