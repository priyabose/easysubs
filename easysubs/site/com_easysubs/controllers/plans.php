<?php

/*------------------------------------------------------------------------
 # com_flycart
# ------------------------------------------------------------------------
# author   Gokila priya   - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2014 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://flycart.org
# Technical Support:  Forum - http://flycart.org/forum/index.html
-------------------------------------------------------------------------*/


// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');


/**
 * HelloWorld Controller
 */

require_once(JPATH_ADMINISTRATOR.'/components/com_easysubs/controllers/default.php');
class EasysubsControllerPlans extends EasysubsControllerDefault
{
public function execute($task) {

		if(!in_array($task, array('subscribe'))) {
			$task = 'browse';
		}

		parent::execute($task);
	}
	
	public function subscribe(){
		$session=JFactory::getSession();
		$app=JFactory::getApplication();
		$post=$app->input->getArray($_POST);
		$plan_id=$post['plan_id'];
		$session->get('easysubs_plan_id','');
		$session->set('easysubs_plan_id'.$plan_id);			
		$msg=JText::_('COM_EASYSUBS_SUCCESS_SUBSCRIPTION');
		$msg_type='Message';
		//$this->redirect('index.php?option=com_easysubs&view=subscription&layout=item&plan_id='.$plan_id,$msg,$msg_type);
		$url ='index.php?option=com_easysubs&view=subscription&layout=item&plan_id='.$plan_id;
		$this->setRedirect($url, $msg);
							
		}
}
