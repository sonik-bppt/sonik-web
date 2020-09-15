<?php

class TransactionData
{

    /**
     * @var MeterValue[] $values
     * @access public
     */
    public $values = null;

    /**
     * @param MeterValue[] $values
     * @access public
     */
    public function __construct($values)
    {
      $this->values = $values;
    }

}
