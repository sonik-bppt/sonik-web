<?php

class MeterValue
{

    /**
     * @var dateTime $timestamp
     * @access public
     */
    public $timestamp = null;

    /**
     * @var SampledValue[] $sampledValue
     * @access public
     */
    public $sampledValue = null;

    /**
     * @param dateTime $timestamp
     * @param SampledValue[] $sampledValue
     * @access public
     */
    public function __construct($timestamp, $sampledValue)
    {
      $this->timestamp = $timestamp;
      $this->sampledValue = $sampledValue;
    }

}
