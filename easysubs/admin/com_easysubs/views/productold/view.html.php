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

class EasysubsViewProduct extends FOFViewHtml
{
	protected function onAdd($tpl = null) {
		$app=JFactory::getApplication();
		$model=$this->getModel();
		$this->item=$model->getItem();		
		$model->getCommonProductInformation($this->item);
		return $this->onAdd($tpl);
		//return true;
	}
}
