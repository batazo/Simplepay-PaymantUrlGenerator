<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\Simplepay\SimplePayGetDatas;


class DefaultController  extends AbstractController
{
    public $simplestartdata;
    public $simplebackdata;

    public function __construct()
    {
        
        
        
    }

    #[Route('/', "home")]
    public function defaultAction(): Response
    {
        $this->simplestartdata = new SimplePayGetDatas();

        //Simulated products from database
        $items = [
            [
                'ref' => '1',
                'title' => 'Cipő',
                'desc' => 'Sportcipő',
                'amount' => '2',
                'price' => '5000',
                'tax' => '0',
            ],
            [
                'ref' => '2',
                'title' => 'Kabát',
                'desc' => 'Télikabát',
                'amount' => '2',
                'price' => '10000',
                'tax' => '0',
            ]
        ];

        $ref = uniqid(true);

        $total = array_reduce($items, function ($carry, $item) {
            return $carry + $item['price'] * $item['amount'];
        }, 0);

        $paymentUrl = $this->simplestartdata->getPaymetUrl($items, $ref, $total);

        return $this->render('default/home.html.twig', [
            'items'=>$items,
            'ref'=> $ref,
            'paymentUrl'=>$paymentUrl
        ]);
    }

    #[Route('/back', "back")]
    public function backAction(Request $request): Response
    {
        $this->simplebackdata = new SimplePayGetDatas();
        $queryArr = $request->query->all();
        $result = $this->simplebackdata->getBackData($queryArr["r"], $queryArr["s"]);

        return $this->render('default/back.html.twig', [
            "result"=>$result
        ]);
    }
}
