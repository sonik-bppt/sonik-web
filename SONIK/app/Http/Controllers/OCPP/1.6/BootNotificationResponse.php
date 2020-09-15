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
     * @var int $interval
     * @access public
     */
    public $interval = null;

    /**
     * @param RegistrationStatus $status
     * @param dateTime $currentTime
     * @param int $interval
     * @access public
     */
    public function __construct($status, $currentTime, $interval)
    {
      $this->status = $status;
      $this->currentTime = $currentTime;
      $this->interval = $interval;
    }

}
