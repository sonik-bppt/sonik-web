<?php

class DataTransferResponse
{

    /**
     * @var DataTransferStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @var string $data
     * @access public
     */
    public $data = null;

    /**
     * @param DataTransferStatus $status
     * @param string $data
     * @access public
     */
    public function __construct($status, $data)
    {
      $this->status = $status;
      $this->data = $data;
    }

}
