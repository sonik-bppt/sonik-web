<?php

class BootNotificationRequest
{

    /**
     * @var CiString20Type $chargePointVendor
     * @access public
     */
    public $chargePointVendor = null;

    /**
     * @var CiString20Type $chargePointModel
     * @access public
     */
    public $chargePointModel = null;

    /**
     * @var CiString25Type $chargePointSerialNumber
     * @access public
     */
    public $chargePointSerialNumber = null;

    /**
     * @var CiString25Type $chargeBoxSerialNumber
     * @access public
     */
    public $chargeBoxSerialNumber = null;

    /**
     * @var CiString50Type $firmwareVersion
     * @access public
     */
    public $firmwareVersion = null;

    /**
     * @var CiString20Type $iccid
     * @access public
     */
    public $iccid = null;

    /**
     * @var CiString20Type $imsi
     * @access public
     */
    public $imsi = null;

    /**
     * @var CiString25Type $meterType
     * @access public
     */
    public $meterType = null;

    /**
     * @var CiString25Type $meterSerialNumber
     * @access public
     */
    public $meterSerialNumber = null;

    /**
     * @param CiString20Type $chargePointVendor
     * @param CiString20Type $chargePointModel
     * @param CiString25Type $chargePointSerialNumber
     * @param CiString25Type $chargeBoxSerialNumber
     * @param CiString50Type $firmwareVersion
     * @param CiString20Type $iccid
     * @param CiString20Type $imsi
     * @param CiString25Type $meterType
     * @param CiString25Type $meterSerialNumber
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
