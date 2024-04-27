<?php

namespace App\Service\Simplepay;

use App\Service\Simplepay\SimplePayStart;
use App\Service\Simplepay\SimplePayBack;

class SimplePayGetDatas
{
    private $config;
    private $currency = "HUF";
    
    public function __construct()
    {
        $this->loadConfig();
    }

    private function loadConfig()
    {
        require __DIR__ . '/../../../config/simplepay.php';
        if (!isset($config) || !is_array($config)) {
            throw new \Exception("Config variable does not exist or is not an array");
        }    
        $this->config = $config;
    }
    private function createTransaction($simpleClass){
        if (!class_exists($simpleClass)) {
            throw new \Exception("Class $simpleClass does not exist");
        }
        $trx = new $simpleClass;
        $trx->addConfig($this->config);
        return $trx;

    }
    public function getPaymetUrl($items, $ref, $total = 0){
        $trx = $this->createTransaction(SimplePayStart::class);
        $trx->addData('currency', $this->currency);
        $trx->addData('total', $total);
        if($items){
            foreach($items as $item){
                $trx->addItems($item);
            }
        }
        
        $trx->addData('orderRef', $ref);
        $trx->addData('customerEmail', 'sdk_test@otpmobil.com');
        $trx->addData('url', 'http://simplepaymenturl.local/back');
        $trx->runStart();
        return $trx->returnData;
    }

    public function getBackData($r, $s){
        $trx = $this->createTransaction(SimplePayBack::class);
        $result = array();
        if (isset($r) && isset($s)) {
            $sign = $trx->isBackSignatureCheck($r, $s);
            dump($sign);
            if ($sign) {
                $result = $trx->getRawNotification();
            }
        }
        return $result;
    }
}