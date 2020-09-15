<?php

class FirmwareStatusNotificationRequest
{

    /**
     * @var FirmwareStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @param FirmwareStatus $status
     * @access public
     */
    public function __construct($status)
    {
      $this->status = $status;
    }

}
