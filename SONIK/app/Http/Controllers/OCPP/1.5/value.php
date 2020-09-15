<?php

class value
{

    /**
     * @var string $_
     * @access public
     */
    public $_ = null;

    /**
     * @var ReadingContext $context
     * @access public
     */
    public $context = null;

    /**
     * @var ValueFormat $format
     * @access public
     */
    public $format = null;

    /**
     * @var Measurand $measurand
     * @access public
     */
    public $measurand = null;

    /**
     * @var Location $location
     * @access public
     */
    public $location = null;

    /**
     * @var UnitOfMeasure $unit
     * @access public
     */
    public $unit = null;

    /**
     * @param string $_
     * @param ReadingContext $context
     * @param ValueFormat $format
     * @param Measurand $measurand
     * @param Location $location
     * @param UnitOfMeasure $unit
     * @access public
     */
    public function __construct($_, $context, $format, $measurand, $location, $unit)
    {
      $this->_ = $_;
      $this->context = $context;
      $this->format = $format;
      $this->measurand = $measurand;
      $this->location = $location;
      $this->unit = $unit;
    }

}
