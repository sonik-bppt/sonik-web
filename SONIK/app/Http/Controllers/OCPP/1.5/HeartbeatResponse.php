<?php

class HeartbeatResponse
{

    /**
     * @var dateTime $currentTime
     * @access public
     */
    public $currentTime = null;

    /**
     * @param dateTime $currentTime
     * @access public
     */
    public function __construct($currentTime)
    {
      $this->currentTime = $currentTime;
    }

}
