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
FOFDispatcher::getTmpInstance('com_easysubs')->dispatch();
