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

require_once(JPATH_ADMINISTRATOR.'/components/com_flycart/helpers/input.php');
$app = JFactory::getApplication();
$model=FOFModel::getTmpInstance('Products','FlycartModel');
$form_prefix='jform[attribs][flycart]';

$catalog_source = $app->input->getString('option');

$catalog_source_id=$app->input->getInt('id', 0);
if($catalog_source == 'com_k2') {
	$cid = $app->input->getArray('cid');
	$catalog_source_id = $cid[0];
}
$this->userGroup=JHtmlUser::groups();

$this->tags=JHtmlTag::tags($catalog_source);
$this->categories=JHtmlCategory::categories($catalog_source);

?>

	<div class="flycart-product-form-container">

		<?php if($catalog_source!='com_flycart'):?>
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_ENABLE_FLYCART_PRODUCT', array())?>
			<div class="controls">

				<?php	$arr = array(JHtml::_('select.option', '0', JText::_('COM_FLYCART_DISABLE') ),
						JHtml::_('select.option', '1', JText::_('COM_FLYCART_ENABLE') )	);
				echo JHtml::_('select.radiolist',$arr,$form_prefix.'[enabled]',null, 'value', 'text',($this->item->enabled)? $this->item->enabled :0);?>
			</div>

		</div>
		<?php endif; ?>

	    <ul class="nav nav-tabs">
	    	 <?php if($catalog_source=='com_flycart'):?>
		   	 <li class="active"><a href="#flycart-general" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_GENERAL')?></a></li>
		    <?php endif; ?>

		    <li <?php echo ($catalog_source=='com_content') ? 'class="active"' : '' ;?> >
		    	<a href="#flycart-pricing" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_PRICING')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-inventory" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_INVENTORY')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-shipping" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_SHIPPING')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-options" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_OPTIONS')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-relationships" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_RELATIONSHIPS')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-images" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_IMAGES')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-visibility" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_VISIBILITY')?></a>
		    </li>
		    <li>
		    	<a href="#flycart-layouts" data-toggle="tab"><?php echo JText::_('COM_FLYCART_PRODUCT_TAB_LAYOUTS')?></a>
		    </li>
	   </ul>
	   <?php if($catalog_source=='com_flycart'):?>
	   <form id="adminForm" class="form-horizontal form-validate" name="adminForm" method="post" action="index.php" enctype="multipart/form-data">
	   <?php endif; ?>
	   <!--

	    -->
		<div class="tab-content">
			 <?php if($catalog_source=='com_flycart'):?>

			<div class="tab-pane active" id="flycart-general">
				<?php echo $this->loadTemplate('general'); ?>
			</div>

			<?php endif;?>
			<div class="tab-pane <?php echo ($catalog_source=='com_content') ? 'active' : '' ;?>" id="flycart-pricing">
				<?php echo $this->loadTemplate('pricing'); ?>
			</div>
			<div class="tab-pane" id="flycart-inventory">
				<?php echo $this->loadTemplate('inventory'); ?>
			</div>
			<div class="tab-pane" id="flycart-shipping">
				<?php echo $this->loadTemplate('shipping'); ?>
			</div>
			<div class="tab-pane" id="flycart-options">
				<?php echo $this->loadTemplate('options'); ?>
			</div>
			<div class="tab-pane" id="flycart-relationships">
				<?php echo $this->loadTemplate('relationship'); ?>
			</div>
			<div class="tab-pane" id="flycart-images">
				<?php echo $this->loadTemplate('images'); ?>
			</div>
			<div class="tab-pane" id="flycart-visibility">
			<?php echo $this->loadTemplate('visibility'); ?>
			</div>
			<div class="tab-pane" id="flycart-layouts">
			<?php echo $this->loadTemplate('layouts'); ?>
			</div>
		</div>

	<?php if($catalog_source=='com_flycart'):?>

		<input type="hidden" value="com_flycart" name="option">
		<input type="hidden" name="<?php echo $form_prefix;?>[catalog_source]"  value="com_flycart">
		<input type="hidden" name="<?php echo $form_prefix;?>[flycart_product_id]" value="<?php echo $this->item->flycart_product_id; ?>">


		<!-- <input type="hidden" name="<?php echo $form_prefix;?>[id]" id="id" value="<?php echo $this->item->flycart_product_id; ?>"> -->

		<input type="hidden" value="product" name="view">
		<input type="hidden" id="task" value="" name="task">
		<?php echo JHtml::_('form.token'); ?>

	</form>

	<?php endif; ?>

	</div>
