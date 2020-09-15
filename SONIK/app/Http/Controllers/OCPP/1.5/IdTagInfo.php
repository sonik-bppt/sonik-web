<?php

class IdTagInfo
{

    /**
     * @var AuthorizationStatus $status
     * @access public
     */
    public $status = null;

    /**
     * @var dateTime $expiryDate
     * @access public
     */
    public $expiryDate = null;

    /**
     * @var IdToken $parentIdTag
     * @access public
     */
    public $parentIdTag = null;

    /**
     * @param AuthorizationStatus $status
     * @param dateTime $expiryDate
     * @param IdToken $parentIdTag
     * @access public
     */
    public function __construct($status, $expiryDate, $parentIdTag)
    {
      $this->status = $status;
      $this->expiryDate = $expiryDate;
      $this->parentIdTag = $parentIdTag;
    }

}
