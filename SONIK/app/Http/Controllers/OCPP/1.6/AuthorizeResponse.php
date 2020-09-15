<?php

class AuthorizeResponse
{

    /**
     * @var IdTagInfo $idTagInfo
     * @access public
     */
    public $idTagInfo = null;

    /**
     * @param IdTagInfo $idTagInfo
     * @access public
     */
    public function __construct($idTagInfo)
    {
      $this->idTagInfo = $idTagInfo;
    }

}
