<?php

class StatusNotificationRequest
{

    /**
     * @var int $connectorId
     * @access public
     */
    public $connectorId = null;

    /**
     * @var ChargePointStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @var ChargePointErrorCode $errorCode
     * @access public
     */
    public $errorCode = null;

    /**
     * @var string $info
     * @access public
     */
    public $info = null;

    /**
     * @var dateTime $timestamp
     * @access public
     */
    public $timestamp = null;

    /**
     * @var string $vendorId
     * @access public
     */
    public $vendorId = null;

    /**
     * @var string $vendorErrorCode
     * @access public
     */
    public $vendorErrorCode = null;

    /**
     * @param int $connectorId
     * @param ChargePointStatus $status
     * @param ChargePointErrorCode $errorCode
     * @param string $info
     * @param dateTime $timestamp
     * @param string $vendorId
     * @param string $vendorErrorCode
     * @access public
     */
    public function __construct($connectorId, $status, $errorCode, $info, $timestamp, $vendorId, $vendorErrorCode)
    {
      $this->connectorId = $connectorId;
      $this->status = $status;
      $this->errorCode = $errorCode;
      $this->info = $info;
      $this->timestamp = $timestamp;
      $this->vendorId = $vendorId;
      $this->vendorErrorCode = $vendorErrorCode;
    }

}
