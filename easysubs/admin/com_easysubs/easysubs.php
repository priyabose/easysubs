<?php
/*
* @package Mailbox
* @copyright Copyright (c)2014 weblogicxindia
* @license GNU General Public License version 2 or later
*/

defined('_JEXEC') or die();
include_once JPATH_LIBRARIES.'/fof/include.php';

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
if(!defined('FOF_INCLUDED'))
	{
		JError::raiseError('500','FOF IS NOT INSTALLED');
	}
//include easysubs API
if (!defined('EASYSUBS_APP_INCLUDED'))
{
	//TODO:: should we move this to the joomla libraries folder.
	
	include_once JPATH_ADMINISTRATOR . '/components/com_easysubs/app/include.php';
}
FOFDispatcher::getTmpInstance('com_easysubs')->dispatch();
