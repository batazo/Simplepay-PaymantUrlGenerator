<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\Simplepay\SimplePayStart;

class DefaultController  extends AbstractController
{
    public function __construct()
    {
        

        
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
                'title' => 'Product name 2',
                'desc' => 'Product description 2',
                'amount' => '1',
                'price' => '2',
                'tax' => '0',
            ]
        ];

        $ref = uniqid(true);
        $paymentUrl = $this->getPaymetUrl($items, $ref);

        return $this->render('default/home.html.twig', [
            'items'=>$items,
            'ref'=> $ref,
            'paymentUrl'=>$paymentUrl
        ]);
    }


    public function getPaymetUrl($items, $ref){

        require_once __DIR__ . '/../../config/simplepay.php';
        
        $trx = new SimplePayStart;
        $currency = 'HUF';
        $trx->addData('currency', $currency);
        $trx->addConfig($config);

        $trx->addData('total', 8);

        foreach($items as $item){
            $trx->addItems($item);
        }
        

        $trx->addData('orderRef', $ref);
        $trx->addData('customerEmail', 'sdk_test@otpmobil.com');
        $trx->addData('url', 'http://simplepaymenturl.local/');
        $trx->runStart();
        return $trx->returnData;
    }
}
