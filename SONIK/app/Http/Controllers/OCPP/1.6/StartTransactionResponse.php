<?php

class StartTransactionResponse
{

    /**
     * @var int $transactionId
     * @access public
     */
    public $transactionId = null;

    /**
     * @var IdTagInfo $idTagInfo
     * @access public
     */
    public $idTagInfo = null;

    /**
     * @param int $transactionId
     * @param IdTagInfo $idTagInfo
     * @access public
     */
    public function __construct($transactionId, $idTagInfo)
    {
      $this->transactionId = $transactionId;
      $this->idTagInfo = $idTagInfo;
    }

}
