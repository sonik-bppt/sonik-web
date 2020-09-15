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
     * @var MeterValue[] $values
     * @access public
     */
    public $values = null;

    /**
     * @param int $connectorId
     * @param int $transactionId
     * @param MeterValue[] $values
     * @access public
     */
    public function __construct($connectorId, $transactionId, $values)
    {
      $this->connectorId = $connectorId;
      $this->transactionId = $transactionId;
      $this->values = $values;
    }

}
