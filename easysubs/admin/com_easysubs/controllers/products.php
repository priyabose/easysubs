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


//require_once('/com_flycart/controllers/default.php');

 /* class FlyCartControllerProducts extends FlycartControllerDefault
{

	function __construct($config) {
		parent::__construct($config);
	}

	public function saveRating()
	{
		$app=JFactory::getApplication();

		$rating=$app->input->getArray($_POST);
		print_r($rating);
		echo $rating['flycart_product_id'];
		//exit;
		$model=FOFModel::getTmpInstance('Products','FlycartModel');
		$item=$model->getItem($rating['flycart_product_id']);
		print_r($item);
		//exit;

	}
}
 */