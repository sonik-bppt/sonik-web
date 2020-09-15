<?php

class DataTransferRequest
{

    /**
     * @var string $vendorId
     * @access public
     */
    public $vendorId = null;

    /**
     * @var string $messageId
     * @access public
     */
    public $messageId = null;

    /**
     * @var string $data
     * @access public
     */
    public $data = null;

    /**
     * @param string $vendorId
     * @param string $messageId
     * @param string $data
     * @access public
     */
    public function __construct($vendorId, $messageId, $data)
    {
      $this->vendorId = $vendorId;
      $this->messageId = $messageId;
      $this->data = $data;
    }

}
