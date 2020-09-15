<?php

class DataTransferRequest
{

    /**
     * @var CiString255Type $vendorId
     * @access public
     */
    public $vendorId = null;

    /**
     * @var CiString50Type $messageId
     * @access public
     */
    public $messageId = null;

    /**
     * @var string $data
     * @access public
     */
    public $data = null;

    /**
     * @param CiString255Type $vendorId
     * @param CiString50Type $messageId
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
