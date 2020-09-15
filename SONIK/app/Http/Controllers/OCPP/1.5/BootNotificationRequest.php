<?php

class BootNotificationRequest
{

    /**
     * @var ChargePointVendor $chargePointVendor
     * @access public
     */
    public $chargePointVendor = null;

    /**
     * @var ChargePointModel $chargePointModel
     * @access public
     */
    public $chargePointModel = null;

    /**
     * @var ChargePointSerialNumber $chargePointSerialNumber
     * @access public
     */
    public $chargePointSerialNumber = null;

    /**
     * @var ChargeBoxSerialNumber $chargeBoxSerialNumber
     * @access public
     */
    public $chargeBoxSerialNumber = null;

    /**
     * @var FirmwareVersion $firmwareVersion
     * @access public
     */
    public $firmwareVersion = null;

    /**
     * @var IccidString $iccid
     * @access public
     */
    public $iccid = null;

    /**
     * @var ImsiString $imsi
     * @access public
     */
    public $imsi = null;

    /**
     * @var MeterType $meterType
     * @access public
     */
    public $meterType = null;

    /**
     * @var MeterSerialNumber $meterSerialNumber
     * @access public
     */
    public $meterSerialNumber = null;

    /**
     * @param ChargePointVendor $chargePointVendor
     * @param ChargePointModel $chargePointModel
     * @param ChargePointSerialNumber $chargePointSerialNumber
     * @param ChargeBoxSerialNumber $chargeBoxSerialNumber
     * @param FirmwareVersion $firmwareVersion
     * @param IccidString $iccid
     * @param ImsiString $imsi
     * @param MeterType $meterType
     * @param MeterSerialNumber $meterSerialNumber
     * @access public
     */
    public function __construct($chargePointVendor, $chargePointModel, $chargePointSerialNumber, $chargeBoxSerialNumber, $firmwareVersion, $iccid, $imsi, $meterType, $meterSerialNumber)
    {
      $this->chargePointVendor = $chargePointVendor;
      $this->chargePointModel = $chargePointModel;
      $this->chargePointSerialNumber = $chargePointSerialNumber;
      $this->chargeBoxSerialNumber = $chargeBoxSerialNumber;
      $this->firmwareVersion = $firmwareVersion;
      $this->iccid = $iccid;
      $this->imsi = $imsi;
      $this->meterType = $meterType;
      $this->meterSerialNumber = $meterSerialNumber;
    }

}
