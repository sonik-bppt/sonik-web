<?php

class SampledValue
{

    /**
     * @var string $value
     * @access public
     */
    public $value = null;

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
     * @var Phase $phase
     * @access public
     */
    public $phase = null;

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
     * @param string $value
     * @param ReadingContext $context
     * @param ValueFormat $format
     * @param Measurand $measurand
     * @param Phase $phase
     * @param Location $location
     * @param UnitOfMeasure $unit
     * @access public
     */
    public function __construct($value, $context, $format, $measurand, $phase, $location, $unit)
    {
      $this->value = $value;
      $this->context = $context;
      $this->format = $format;
      $this->measurand = $measurand;
      $this->phase = $phase;
      $this->location = $location;
      $this->unit = $unit;
    }

}
