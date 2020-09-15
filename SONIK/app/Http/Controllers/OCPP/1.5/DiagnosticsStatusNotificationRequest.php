<?php

class DiagnosticsStatusNotificationRequest
{

    /**
     * @var DiagnosticsStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @param DiagnosticsStatus $status
     * @access public
     */
    public function __construct($status)
    {
      $this->status = $status;
    }

}
