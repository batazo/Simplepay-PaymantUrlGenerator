<?php

namespace App\Service\Simplepay;

use App\Service\Simplepay\SimplePayStart;

class SimplePayGetDatas
{

    private $config;
    private $currency;
    private $trx;

    public function __construct()
    {
        require_once __DIR__ . '/../../../config/simplepay.php';
        $this->config = $config;
        $this->currency = 'HUF';
        $this->trx = new SimplePayStart;
    }
    public function getPaymetUrl($items, $ref){
        
        $this->trx->addData('currency', $this->currency);
        $this->trx->addConfig($this->config);

        $this->trx->addData('total', 8);

        foreach($items as $item){
            $this->trx->addItems($item);
        }
        
        $this->trx->addData('orderRef', $ref);
        $this->trx->addData('customerEmail', 'sdk_test@otpmobil.com');
        $this->trx->addData('url', 'http://simplepaymenturl.local/');
        $this->trx->runStart();
        return $this->trx->returnData;
    }
}