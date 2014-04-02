<?php

defined('_JEXEC') or die;

/**
 * FlyCart helper.
  */
class EasysubsHelper
{


	public static function addSubmenu($vName)
	{
	//initialise FOF
	if (!defined('FOF_INCLUDED'))
	{
		include_once JPATH_LIBRARIES . '/fof/include.php';
	}
		return FOFToolbar::getAnInstance('com_flycart')->easysubsHelperRenderSubmenu($vName);
	}

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




}
