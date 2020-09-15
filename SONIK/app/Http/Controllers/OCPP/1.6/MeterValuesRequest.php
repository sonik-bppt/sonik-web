<?php

class MeterValuesRequest
{

    /**
     * @var int $connectorId
     * @access public
     */
    public $connectorId = null;

    /**
     * @var int $transactionId
     * @access public
     */
    public $transactionId = null;

    /**
     * @var MeterValue[] $meterValue
     * @access public
     */
    public $meterValue = null;

    /**
     * @param int $connectorId
     * @param int $transactionId
     * @param MeterValue[] $meterValue
     * @access public
     */
    public function __construct($connectorId, $transactionId, $meterValue)
    {
      $this->connectorId = $connectorId;
      $this->transactionId = $transactionId;
      $this->meterValue = $meterValue;
    }

}
