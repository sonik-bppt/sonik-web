<?php

class StartTransactionRequest
{

    /**
     * @var int $connectorId
     * @access public
     */
    public $connectorId = null;

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
     * @var int $meterStart
     * @access public
     */
    public $meterStart = null;

    /**
     * @var int $reservationId
     * @access public
     */
    public $reservationId = null;

    /**
     * @param int $connectorId
     * @param IdToken $idTag
     * @param dateTime $timestamp
     * @param int $meterStart
     * @param int $reservationId
     * @access public
     */
    public function __construct($connectorId, $idTag, $timestamp, $meterStart, $reservationId)
    {
      $this->connectorId = $connectorId;
      $this->idTag = $idTag;
      $this->timestamp = $timestamp;
      $this->meterStart = $meterStart;
      $this->reservationId = $reservationId;
    }

}
