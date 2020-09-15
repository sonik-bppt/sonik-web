<?php

class AuthorizeRequest
{

    /**
     * @var IdToken $idTag
     * @access public
     */
    public $idTag = null;

    /**
     * @param IdToken $idTag
     * @access public
     */
    public function __construct($idTag)
    {
      $this->idTag = $idTag;
    }

}
