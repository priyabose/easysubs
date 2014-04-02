<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * HelloWorld Controller
 */

require_once('default.php');
class EasysubsControllerCpanels extends EasysubsControllerDefault
{
	public function execute($task) {
		if(!in_array($task, array('browse','hide2copromo'))) {
			$task = 'browse';
		}
		parent::execute($task);
	}
}
