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
/**
 * flycart View
 */
class EasysubsViewProducts extends FOFViewHtml
{

	protected $state;
	protected $pagination;
	protected $lists = array();
	protected $context = 'com_flycart';
	/**
	 * flycart cart view display method
	 * @return void
	 */
	protected function onBrowse($tpl = null)
	{
		// When in interactive browsing mode, save the state to the session

		//	get the application object
		$app=JFactory::getApplication();
				
		$input=JFactory::getApplication()->input;
		 // get the model

		$model=$this->getModel();

		$this->state=$model->getState();

		$this->filter_order		= $app->getUserStateFromRequest( $this->context.'filter_order',		'filter_order',		$input->getString('filter_order') );
		$this->filter_order_Dir	= $app->getUserStateFromRequest( $this->context.'filter_order_Dir',	'filter_order_Dir',	 $input->getString('filter_order_Dir'));
		$this->filter_search = $app->getUserStateFromRequest($this->context . '.filter_search', 'filter_search',$input->getString('filter_search'));
		$this->sortFields = $model->getSortFields();

		$this->items=$model->getList();

		foreach($this->items as $item)
		{
			$model->getCommonProductInformation($item, $field='');
		}


		// get the pagination class object
		$page=$model->getPagination();

		// get the pagelist footer
		$this->pageList=$page->getListFooter();

		// get the limitbox
		$this->limit_box=$page->getLimitBox();




		//$this->items->product_title;
		return $this->onDisplay($tpl);
	}


}
