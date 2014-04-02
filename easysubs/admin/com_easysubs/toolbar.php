<?php
/**
 * @package     FrameworkOnFramework
 * @subpackage  com_dataimport
 * @copyright   Copyright (C) 2010 - 2012 Akeeba Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


// Protect from unauthorized access
defined('_JEXEC') or die();

class EasysubsToolbar extends FOFToolbar {

	
	public function easysubsHelperRenderSubmenu($vName)
	{
		return $this->renderSubmenu($vName);
	}
	
	
	/*
	 * ->cpanels
		->subscriptions
			->Subscriptions
			->invoices
			->Transactions
			->Email Logs
		->Product config
			->plans
			->addons
			->coupons
			->CouponSets
		->Report
			->Monthly
			->ARPU
			->Revenue Summary
			->Transaction Summary
			->Lost Opportunity
			->Refund Summary
			->Export Data
			->Exported List
	
	*/
	public function renderSubmenu($vName = null)
	{
		if(is_null($vName)) {
			$vName = $this->input->getCmd('view','cpanel');
		}

		$this->input->set('view', $vName);
		//parent::renderSubmenu();
		$views = array(
				'cpanel',
				'COM_EASYSUBS_MAINMENU_SUBSCRIPTIONS' => array(
						'subscriptions',
						'invoices',
						'transactions',
						'email logs'			
				),
				'COM_EASYSUBS_MAINMENU_PRODUCT_CONFIG' => array(
						'products',
						'plans',
						'addons',
						'coupons',
						'couponsets'
						
				),

				'COM_EASYSUBS_MAINMENU_REPORT' => array(
						'monthly Reports',
						'ARPUS',
						'Revenue Summaries',
						'Transaction Summaries',
						'Lost Opportunitites',
						'Refund Summaries',
						'Export Data',
						'Exported List',
				),
				
				'COM_EASYSUBS_MAINMENU_SETUP' => array(
						'stores',
						'currencies',
						'emailtemplates',
						'payments',
						'shippings',
						'customfields'
				)
		);


		foreach($views as $label => $view) {
			if(!is_array($view)) {
				$this->addSubmenuLink($view);
			} else {
				$label = JText::_($label);
				$this->appendLink($label, '', false);
				foreach($view as $v) {
					$this->addSubmenuLink($v, $label);
					//$this->renderCategorySubmenu($v);

				}
			}
		}


	}
private function addSubmenuLink($view, $parent = null)
	{
		static $activeView = null;
		if(empty($activeView)) {
			$activeView = $this->input->getCmd('view','cpanel');
		}

		if ($activeView == 'cpanels')
		{
			$activeView = 'cpanel';
		}

		$key = strtoupper($this->component).'_TITLE_'.strtoupper($view);
		if(strtoupper(JText::_($key)) == $key) {
			$altview = FOFInflector::isPlural($view) ? FOFInflector::singularize($view) : FOFInflector::pluralize($view);
			$key2 = strtoupper($this->component).'_TITLE_'.strtoupper($altview);
			if(strtoupper(JText::_($key2)) == $key2) {
				$name = ucfirst($view);
			} else {
				$name = JText::_($key2);
			}
		} else {
			$name = JText::_($key);
		}

		$link = 'index.php?option='.$this->component.'&view='.$view;

		if($view == 'categories') {
			$link = 'index.php?option=com_categories&extension='.$this->component;
		}

		$active = $view == $activeView;

		$this->appendLink($name, $link, $active, null, $parent);
	}


}
