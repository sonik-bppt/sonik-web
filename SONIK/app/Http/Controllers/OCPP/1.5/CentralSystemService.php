<?php

include_once('AuthorizationStatus.php');
include_once('IdTagInfo.php');
include_once('AuthorizeRequest.php');
include_once('AuthorizeResponse.php');
include_once('StartTransactionRequest.php');
include_once('StartTransactionResponse.php');
include_once('TransactionData.php');
include_once('StopTransactionRequest.php');
include_once('StopTransactionResponse.php');
include_once('HeartbeatRequest.php');
include_once('HeartbeatResponse.php');
include_once('ReadingContext.php');
include_once('Measurand.php');
include_once('ValueFormat.php');
include_once('UnitOfMeasure.php');
include_once('Location.php');
include_once('MeterValue.php');
include_once('value.php');
include_once('MeterValuesRequest.php');
include_once('MeterValuesResponse.php');
include_once('BootNotificationRequest.php');
include_once('RegistrationStatus.php');
include_once('BootNotificationResponse.php');
include_once('ChargePointErrorCode.php');
include_once('ChargePointStatus.php');
include_once('StatusNotificationRequest.php');
include_once('StatusNotificationResponse.php');
include_once('FirmwareStatus.php');
include_once('FirmwareStatusNotificationRequest.php');
include_once('FirmwareStatusNotificationResponse.php');
include_once('DiagnosticsStatus.php');
include_once('DiagnosticsStatusNotificationRequest.php');
include_once('DiagnosticsStatusNotificationResponse.php');
include_once('DataTransferRequest.php');
include_once('DataTransferStatus.php');
include_once('DataTransferResponse.php');


/**
 * The Central System Service for the Open Charge Point Protocol
 */
class CentralSystemService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
      'IdTagInfo' => '\IdTagInfo',
      'AuthorizeRequest' => '\AuthorizeRequest',
      'AuthorizeResponse' => '\AuthorizeResponse',
      'StartTransactionRequest' => '\StartTransactionRequest',
      'StartTransactionResponse' => '\StartTransactionResponse',
      'TransactionData' => '\TransactionData',
      'StopTransactionRequest' => '\StopTransactionRequest',
      'StopTransactionResponse' => '\StopTransactionResponse',
      'HeartbeatRequest' => '\HeartbeatRequest',
      'HeartbeatResponse' => '\HeartbeatResponse',
      'MeterValue' => '\MeterValue',
      'value' => '\value',
      'MeterValuesRequest' => '\MeterValuesRequest',
      'MeterValuesResponse' => '\MeterValuesResponse',
      'BootNotificationRequest' => '\BootNotificationRequest',
      'BootNotificationResponse' => '\BootNotificationResponse',
      'StatusNotificationRequest' => '\StatusNotificationRequest',
      'StatusNotificationResponse' => '\StatusNotificationResponse',
      'FirmwareStatusNotificationRequest' => '\FirmwareStatusNotificationRequest',
      'FirmwareStatusNotificationResponse' => '\FirmwareStatusNotificationResponse',
      'DiagnosticsStatusNotificationRequest' => '\DiagnosticsStatusNotificationRequest',
      'DiagnosticsStatusNotificationResponse' => '\DiagnosticsStatusNotificationResponse',
      'DataTransferRequest' => '\DataTransferRequest',
      'DataTransferResponse' => '\DataTransferResponse');

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $wsdl = 'ocpp_centralsystemservice_1.5_final.wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      
      parent::__construct($wsdl, $options);
    }

    /**
     * @param AuthorizeRequest $parameters
     * @access public
     * @return AuthorizeResponse
     */
    public function Authorize(AuthorizeRequest $parameters)
    {
      return $this->__soapCall('Authorize', array($parameters));
    }

    /**
     * @param StartTransactionRequest $parameters
     * @access public
     * @return StartTransactionResponse
     */
    public function StartTransaction(StartTransactionRequest $parameters)
    {
      return $this->__soapCall('StartTransaction', array($parameters));
    }

    /**
     * @param StopTransactionRequest $parameters
     * @access public
     * @return StopTransactionResponse
     */
    public function StopTransaction(StopTransactionRequest $parameters)
    {
      return $this->__soapCall('StopTransaction', array($parameters));
    }

    /**
     * @param HeartbeatRequest $parameters
     * @access public
     * @return HeartbeatResponse
     */
    public function Heartbeat(HeartbeatRequest $parameters)
    {
      return $this->__soapCall('Heartbeat', array($parameters));
    }

    /**
     * @param MeterValuesRequest $parameters
     * @access public
     * @return MeterValuesResponse
     */
    public function MeterValues(MeterValuesRequest $parameters)
    {
      return $this->__soapCall('MeterValues', array($parameters));
    }

    /**
     * @param BootNotificationRequest $parameters
     * @access public
     * @return BootNotificationResponse
     */
    public function BootNotification(BootNotificationRequest $parameters)
    {
      return $this->__soapCall('BootNotification', array($parameters));
    }

    /**
     * @param StatusNotificationRequest $parameters
     * @access public
     * @return StatusNotificationResponse
     */
    public function StatusNotification(StatusNotificationRequest $parameters)
    {
      return $this->__soapCall('StatusNotification', array($parameters));
    }

    /**
     * @param FirmwareStatusNotificationRequest $parameters
     * @access public
     * @return FirmwareStatusNotificationResponse
     */
    public function FirmwareStatusNotification(FirmwareStatusNotificationRequest $parameters)
    {
      return $this->__soapCall('FirmwareStatusNotification', array($parameters));
    }

    /**
     * @param DiagnosticsStatusNotificationRequest $parameters
     * @access public
     * @return DiagnosticsStatusNotificationResponse
     */
    public function DiagnosticsStatusNotification(DiagnosticsStatusNotificationRequest $parameters)
    {
      return $this->__soapCall('DiagnosticsStatusNotification', array($parameters));
    }

    /**
     * @param DataTransferRequest $parameters
     * @access public
     * @return DataTransferResponse
     */
    public function DataTransfer(DataTransferRequest $parameters)
    {
      return $this->__soapCall('DataTransfer', array($parameters));
    }

}
