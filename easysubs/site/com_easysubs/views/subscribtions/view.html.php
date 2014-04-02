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
defined('_JEXEC') or die;
jimport('joomla.plugin.helper');

class EasysubsViewSubscribtions extends FOFViewHtml
{
	protected function onBrowse($tpl=null){
			
		$app=JFactory::getApplication();
		$plan_id=$app->input->getInt('plan_id');
		$product_id=$app->input->getInt('product_id');
		$product_model=FOFModel::getTmpInstance('Products','EasysubsModel');
		$this->product_item=$product_model->getItem($product_id);		
		$plan_model=FOFModel::getTmpInstance('Plans','EasysubsModel');
		$this->plan_item=$plan_model->getItem($plan_id);
		return true;
		}
}
