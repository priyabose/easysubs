<?php
/**
*  @package     Easysubs
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;

class EasySubsDate extends EasysubsCore {

	protected static $flyinstance;
	private $code = null;
	private $data = array();
	private $currencies = array();

	public function __construct($args = array()) {

		if(isset($args['code'])) {
			$this->code  = $args['code'];
		}

		if(!is_object($this->flyconfig)) {

			$this->flyconfig = EasySubsConfig::getFlyInstance();
		}

		//$this->flyInit();

	}

	public static function getFlyInstance($args=array())
	{
		if (!is_object(self::$flyinstance))
		{
			self::$flyinstance = new self($args);
		}

		return self::$flyinstance;
	}
	
	public static function  getValidDate($period_unit,$period)
	{	
		$monthToAdd = 1;
		$dd=new DateTime();
		print_r($dd);
		$today = $dd->date;
		$today = $dd->date;
		$d1 = DateTime::createFromFormat('Y-m-d H:i:s', '2011-01-30 15:57:57');
		print_r($d1);
		switch($period_unit)
		{
			case 'year':
			$year = $d1->format('Y');
			$month=$d1->format('n');
			$day=$d1->format('d');
			$year += floor($monthToAdd/12)+$period;
			$monthToAdd = $monthToAdd%12;
			$month += $monthToAdd;
	
			break;
			case 'month':
			$year = $d1->format('Y');
			$month=$d1->format('n');
			$day=$d1->format('d');			
			$year = floor($monthToAdd/12);
			$monthToAdd = $monthToAdd%12;
			$month += $monthToAdd + $period;
			break;
			case 'day':
			$year = $d1->format('Y');
			$month=$d1->format('n');
			$day=$d1->format('d');			
			$year = floor($monthToAdd/12);
			$monthToAdd = $monthToAdd%12;
			$month += $monthToAdd;			
			break;
			
		}
		
	
	if($month > 12) {
    $year ++;
    $month = $month % 12;
    if($month === 0)
        $month = 12;
}

if(!checkdate($month, $day, $year)) {
    $d2 = DateTime::createFromFormat('Y-n-j', $year.'-'.$month.'-1');
    $d2->modify('last day of');
}else {
    $d2 = DateTime::createFromFormat('Y-n-d', $year.'-'.$month.'-'.$day);
}
$d2->setTime($d1->format('H'), $d1->format('i'), $d1->format('s'));
echo $d2->format('Y-m-d H:i:s');
	}
}
