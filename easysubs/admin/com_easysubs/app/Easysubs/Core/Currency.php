<?php
/**
*  @package     Easysubs
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;

class EasySubsCurrency extends EasysubsCore {

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

		$this->flyInit();

	}

	public static function getFlyInstance($args=array())
	{
		if (!is_object(self::$flyinstance))
		{
			self::$flyinstance = new self($args);
		}

		return self::$flyinstance;
	}

	private function flyInit() {

		$rows = FOFModel::getTmpInstance('currencies', 'EasysubsModel')->enabled(1)->getList();

		foreach ($rows as $result) {

			$this->currencies[$result->currency_code] = $result;
		}
		$session = JFactory::getSession();
		$currency = JFactory::getApplication()->input->get('currency');
		if (isset($currency) && (array_key_exists($currency, $this->currencies))) {
			$this->setCode($currency);
		} elseif ($session->has('currency', self::$namespace) && (array_key_exists($session->get('currency', '', self::$namespace), $this->currencies))) {
			$this->setCode($session->get('currency', '', self::$namespace));
		} else {
			$this->setCode($this->flyconfig->store_currency);
		}

	}

	public function setCode($currency) {
		$this->code = $currency;
		$session = JFactory::getSession();
		if (!$session->has('currency', self::$namespace) || ($session->get('currency', '', self::$namespace) != $currency)) {
			$session->set('currency', $currency, self::$namespace);
		}
	}

	public function getCode() {

		return $this->code;
	}

	public function getSymbol($code='') {
		if(!empty($code) && $this->hasCode($code)) {
			$code = $code;
		} else {
			$code = $this->code;
		}
		return $this->currencies[$code]->currency_symbol;
	}

	public function hasCode($currency) {
		return isset($this->currencies[$currency]);
	}

	public function format($number, $currency = '', $value = '', $format = true) {
		if ($currency && $this->has($currency)) {
			$currency_position  = $this->currencies[$currency]->currency_position;
			$currency_symbol  = $this->currencies[$currency]->currency_symbol;
			$decimal_place = $this->currencies[$currency]->currency_decimal_place;
		} else {
			$currency_position  = $this->currencies[$this->code]->currency_position;
			$currency_symbol  = $this->currencies[$this->code]->currency_symbol;
			$decimal_place = $this->currencies[$this->code]->currency_decimal_place;

			$currency = $this->code;
		}

		if ($value) {
			$value = $value;
		} else {
			$value = $this->currencies[$currency]->currency_value;
		}

		if ($value) {
			$value = (float)$number * $value;
		} else {
			$value = $number;
		}

		$string = '';

		if (($currency_position == 'front') && ($format)) {
			$string .= $currency_symbol;
		}

		if ($format) {
			$decimal_point = $this->currencies[$currency]->currency_decimal_separator;
		} else {
			$decimal_point = '.';
		}

		if ($format) {
			$thousand_point = $this->currencies[$currency]->currency_thousand_separator;
		} else {
			$thousand_point = '';
		}

		$string .= number_format(round($value, (int)$decimal_place), (int)$decimal_place, $decimal_point, $thousand_point);

		if (($currency_position == 'end') && ($format)) {
			$string .= $currency_symbol;
		}

		return $string;
	}

	public function convert($value, $from, $to) {
		if (isset($this->currencies[$from])) {
			$from = $this->currencies[$from]->currency_value;
		} else {
			$from = 0;
		}

		if (isset($this->currencies[$to])) {
			$to = $this->currencies[$to]->currency_value;
		} else {
			$to = 0;
		}

		return $value * ($to / $from);
	}

	public function has($currency) {
		return isset($this->currencies[$currency]);
	}

	public function getValue($currency = '') {

		if (!$currency) {

			return $this->currencies[$this->code]->currency_value;
		} elseif ($currency && isset($this->currencies[$currency])) {
			return $this->currencies[$currency]->currency_value;
		} else {
			return 0;
		}
	}

	public function getCurrencyId($currency = '') {

		if (!$currency) {

			return $this->currencies[$this->code]->flycart_currency_id;

		} elseif ($currency && isset($this->currencies[$currency])) {

			return $this->currencies[$currency]->flycart_currency_id;

		} else {

			return 0;
		}
	}


}
