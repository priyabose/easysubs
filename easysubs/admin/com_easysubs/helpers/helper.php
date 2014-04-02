<?php

defined('_JEXEC') or die;

/**
 * FlyCart helper.
  */
class EasysubsHelper
{

		/*
	public static function addSubmenu($vName)
	{
	//initialise FOF
	if (!defined('FOF_INCLUDED'))
	{
		include_once JPATH_LIBRARIES . '/fof/include.php';
	}
		return FOFToolbar::getAnInstance('com_easysubs')->flycartHelperRenderSubmenu($vName);
	}
 */
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

			$assetName = 'com_easysubs';
			$level = 'component';


		$actions = JAccess::getActions('com_easysubs', $level);

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}

public static function getCountries() {
		$enabled = 1;
		$countries = FOFModel::getTmpInstance('Countries', 'EasysubsModel')
		->enabled($enabled)
		->getList(true);
		$result = array();

		foreach($countries as $country) {
			$result[$country->flycart_country_id] =$country->country_name;
		}
		return $result;
	}

	public static function getCurrencies() {
		$enabled = 1;
		$currencies = FOFModel::getTmpInstance('Currencies', 'EasysubsModel')
		->enabled($enabled)
		->getList(true);
		foreach($currencies as $currency) {
			$result[$currency->currency_code]=$currency->currency_title;
		}
		return $result;
	}
	
	public static function getZones() {
		$enabled = 1;
		$zones = FOFModel::getTmpInstance('Zones', 'EasysubsModel')
		->enabled($enabled)
		->getList(true);
		return $zones;
	}
	
	public static function getEasySubsStatus() {
		$enabled = 1;
		$status = FOFModel::getTmpInstance('statuses', 'EasysubsModel')
		->enabled($enabled)
		->getList(true);
		return $status;
	}

	public static function getCatalogSource()
	{
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select('c.extension')->from('#__categories as c');
		$db->setQuery($query);
		$result =$db->loadObjectList();
		$catalog=array();
		foreach($result as $item) {
			if(($item->extension=='com_easysubs') || ($item->extension=='com_content') || ($item->extension=='com_k2'))
			{
			$catalog[$item->extension] =$item->extension;
			}
		}
		return $catalog;
	}

	public static function  getProductName(){
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query->select('*.product')->from('#__easysubs_products as product');
		$db->setQuery($query);
		$result =$db->loadObjectList();
		$catalog=array();
		foreach($result as $item) {
				
			$catalog[$item->easysubs_product_id] =$item->product_title;
			
		}
		return $catalog;
	}


}

