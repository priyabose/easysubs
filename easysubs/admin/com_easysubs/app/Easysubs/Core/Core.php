<?php
/**
*  @package     Easysubs
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;
//include_once JPATH_ADMINISTRATOR . '/components/com_easysubs/app/Easysubs/Core/CoreAbstract.php';
class EasysubsCore extends EasysubsCoreAbstract {

	public $flyconfig = null;

	public function __construct() {

	}

	public static function coreInit() {
		self::$store_id = JFactory::getSession()->get('store_id', '1', self::$namespace);
	}

	public static function getTable($name, $prefix='EasysubsTable') {
		return FOFTable::getInstance($name, $prefix);
	}

	public function getSession()
	{
		return JFactory::getSession();
	}

}
