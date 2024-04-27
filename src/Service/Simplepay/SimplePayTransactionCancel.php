<?php

namespace App\Service\Simplepay;

/**
  * Cancel of transaction
  *
  * @category SDK
  * @package  SimplePayV2_SDK
  * @author   SimplePay IT Support <itsupport@otpmobil.com>
  * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
  * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
  */
class SimplePayTransactionCancel extends Base
{
    protected $currentInterface = 'transactioncancel';
    public $returnData = [];
    public $transactionBase = [
        'salt' => '',
        'merchant' => '',
        ];

    /**
     * Run transaction cancel
     *
     * @return array $result API response
     */
    public function runTransactionCancel()
    {
        if ($this->transactionBase['orderRef'] === '') {
            unset($this->transactionBase['orderRef']);
            if ($this->transactionBase['transactionId'] !== '') {
                $this->logTransactionId = $this->transactionBase['transactionId'];
            }
        }

        if ($this->transactionBase['transactionId'] == '') {
            unset($this->transactionBase['transactionId']);
            if ($this->transactionBase['orderRef'] !== '') {
                $this->logOrderRef = $this->transactionBase['orderRef'];
            }
        }

        return $this->execApiCall();
    }
}