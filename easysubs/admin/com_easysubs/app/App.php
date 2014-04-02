<?php
/**
*  @package     Easysubs
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;

require 'Easysubs/Core/CoreAbstract.php';
require 'Easysubs/Core/Core.php';
require 'Easysubs/Core/Tax.php';
require 'Easysubs/Core/Date.php';
require 'Easysubs/Core/Currency.php';
require 'Easysubs/Config/Config.php';



class Easysubs {

	/*An instance of the EasysubsApp
	 *
	 * @var Easysubs
	 */
	public static $autoloader = null;
	public static $currency = null;
	public static $product = null;
	public static $tax = null;
	public static $cart = null;
	public static $date=null;
	public static $payment=null;
	public static $field=null;
	public static $account=null;

	function __construct() {
	}

	/**
	 * Retrieve config object or config value,
	 * if name is requested
	 *
	 * @static
	 * @param string $name[optional] config value to load
	 * @param string $default[optional] default value to return
	 * @return object Axis_Config|mixed
	 */
	public static function config($name, $default=null) {
		$class = EasySubsConfig::getFlyInstance();
		if (null !== $name) {

			return $class->getConfig($name, $default);
		}
		return $class;

	}

	public static function currency($args=array()) {

		if (self::$currency == null)
		{
			self::$currency= EasySubsCurrency::getFlyInstance($args);
		}
		return self::$currency;
	}

	


	

	public static function tax($args=array())
	{
		if(self::$tax == null)
		{
			self::$tax= EasySubsTax::getFlyInstance($args);
		}
		return self::$tax;
	}


	public static function init()
	{
		//include fof
		if (!defined('FOF_INCLUDED'))
		{
			include_once JPATH_LIBRARIES . '/fof/include.php';
		}

		//initialise core
		EasysubsCore::coreInit();

		//initialsie config
		EasysubsConfig::getFlyInstance();

		if (self::$autoloader == null)
		{
			self::$autoloader = new self;
		}

		return self::$autoloader;
	}

	

	public static function  load($className,$arguments=array() )
	{
		$classPrefix="EasySubs";
		$class= $classPrefix.ucfirst($className);
		return new $class($arguments);
	}

}
