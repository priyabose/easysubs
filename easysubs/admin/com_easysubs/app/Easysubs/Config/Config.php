<?php
/**
*  @package     Flycart
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;

class EasySubsConfig extends EasysubsCore {

	protected static $flyinstance = null;

	public $flyconfig = null;
	public $_data = null;

	public function __construct($arguements) {

		$this->_data = $this->loadData();
		$this->flyconfig = $this->_data;

	}
	public static function getFlyInstance($arguements = array())
	{
		// Only create the object if it doesn't exist.
		if (empty(self::$flyinstance))
		{
			self::$flyinstance  = new self($arguements);
		}
		return self::$flyinstance;
	}

	public function getConfig($name, $default=null) {

		if(!is_null($this->_data) && isset($this->_data->$name)) {
				return $this->_data->$name;
			} else {
				return $default;
		}
	}

	private function loadData() {

		if(self::$store_id ) {
			$table = self::getTable('Store');
			$table->load(array('easysubs_store_id'=>self::$store_id));
			$this->_data = $table;
		}
		return $this->_data;
	}

	public function __get($name) {
		if(isset($this->_data->$name)) {
			return $this->_data->$name;
		} else {
			return null;
		}

	}
}
