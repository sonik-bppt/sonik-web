<?php

class MeterValue
{

    /**
     * @var dateTime $timestamp
     * @access public
     */
    public $timestamp = null;

    /**
     * @var value[] $value
     * @access public
     */
    public $value = null;

    /**
     * @param dateTime $timestamp
     * @param value[] $value
     * @access public
     */
    public function __construct($timestamp, $value)
    {
      $this->timestamp = $timestamp;
      $this->value = $value;
    }

}
