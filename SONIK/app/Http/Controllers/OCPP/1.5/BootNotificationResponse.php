<?php

class BootNotificationResponse
{

    /**
     * @var RegistrationStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @var dateTime $currentTime
     * @access public
     */
    public $currentTime = null;

    /**
     * @var int $heartbeatInterval
     * @access public
     */
    public $heartbeatInterval = null;

    /**
     * @param RegistrationStatus $status
     * @param dateTime $currentTime
     * @param int $heartbeatInterval
     * @access public
     */
    public function __construct($status, $currentTime, $heartbeatInterval)
    {
      $this->status = $status;
      $this->currentTime = $currentTime;
      $this->heartbeatInterval = $heartbeatInterval;
    }

}
