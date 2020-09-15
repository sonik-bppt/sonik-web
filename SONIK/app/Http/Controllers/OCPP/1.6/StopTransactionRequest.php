<?php

class StopTransactionRequest
{

    /**
     * @var int $transactionId
     * @access public
     */
    public $transactionId = null;

    /**
     * @var IdToken $idTag
     * @access public
     */
    public $idTag = null;

    /**
     * @var dateTime $timestamp
     * @access public
     */
    public $timestamp = null;

    /**
     * @var int $meterStop
     * @access public
     */
    public $meterStop = null;

    /**
     * @var Reason $reason
     * @access public
     */
    public $reason = null;

    /**
     * @var MeterValue[] $transactionData
     * @access public
     */
    public $transactionData = null;

    /**
     * @param int $transactionId
     * @param IdToken $idTag
     * @param dateTime $timestamp
     * @param int $meterStop
     * @param Reason $reason
     * @param MeterValue[] $transactionData
     * @access public
     */
    public function __construct($transactionId, $idTag, $timestamp, $meterStop, $reason, $transactionData)
    {
      $this->transactionId = $transactionId;
      $this->idTag = $idTag;
      $this->timestamp = $timestamp;
      $this->meterStop = $meterStop;
      $this->reason = $reason;
      $this->transactionData = $transactionData;
    }

}
