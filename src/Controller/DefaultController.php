<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\Simplepay\SimplePayGetDatas;

class DefaultController  extends AbstractController
{
    public $simpledata;
    public function __construct(SimplePayGetDatas $simpledata)
    {
        $this->simpledata = $simpledata;
    }

    #[Route('/', "home")]
    public function defaultAction(): Response
    {
        $items = [
            [
                'ref' => 'Product ID 1',
                'title' => 'Product name 1',
                'desc' => 'Product description 1',
                'amount' => '1',
                'price' => '5',
                'tax' => '0',
            ],
            [
                'ref' => 'Product ID 1',
                'title' => 'Product name 1',
                'desc' => 'Product description 1',
                'amount' => '1',
                'price' => '5',
                'tax' => '0',
            ]
        ];

        $ref = uniqid(true);
        $paymentUrl = $this->simpledata->getPaymetUrl($items, $ref);

        return $this->render('default/home.html.twig', [
            'items'=>$items,
            'ref'=> $ref,
            'paymentUrl'=>$paymentUrl
        ]);
    }


    
}
