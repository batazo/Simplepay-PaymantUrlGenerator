<?php

namespace App\Service\Simplepay;

/**
 * Query
 *
 * @category SDK
 * @package  SimplePayV2_SDK
 * @author   SimplePay IT Support <itsupport@otpmobil.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
class SimplePayQuery extends Base
{
    protected $currentInterface = 'query';
    public $returnData = [];
    protected $transactionBase = [
        'salt' => '',
        'merchant' => ''
    ];

    /**
     * Add SimplePay transaction ID to query
     *
     * @param string $simplePayId SimplePay transaction ID
     *
     * @return void
     */
    public function addSimplePayId($simplePayId = '')
    {
        if (!isset($this->transactionBase['transactionIds'])) {
            $this->transactionBase['transactionIds'] = [];
            $this->logTransactionId = $simplePayId;
        } 
        $this->transactionBase['transactionIds'][] = $simplePayId;
    }

    /**
     * Add merchant order ID to query
     *
     * @param string $merchantOrderId Merchant order ID
     *
     * @return void
     */
    public function addMerchantOrderId($merchantOrderId = '')
    {
        if (!isset($this->transactionBase['orderRefs'])) {
            $this->transactionBase['orderRefs'] = [];
            $this->logOrderRef = $merchantOrderId;
        } 
        $this->transactionBase['orderRefs'][] = $merchantOrderId;
    }

    /**
     * Run transaction data query
     *
     * @return array $result API response
     */
    public function runQuery()
    {
        return $this->execApiCall();
    }
}