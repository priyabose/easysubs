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

$app=JFactory::getApplication();
$catalog_source = $app->input->getString('option');
$form_prefix='jform[attribs][flycart]';
$model = FOFModel::getTmpInstance('Products', 'FlycartModel');


$layouts=$model->getLayoutType('product');
    ?>

<div class="row-fluid">
	<div class="span2">

	</div>
		<div class="span10">
			<div class="control-group">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_LAYOUT', array())?>
				<div class="controls">
				<?php

					 		foreach($layouts as $productLayout)  {
							$productLayoutOption[]=JHtml::_('select.option',$productLayout->flycart_layout_id,$productLayout->layout_name);
						}
				    	$attribs = array('class' => 'inputbox', 'id' => 'jformproduct_layout_id','onchange'=>'javascript:setLayoutvalue(this.value)', 'size'=>'1', 'title'=>JText::_('COM_FLYCART_PRODUCT_LAYOUT'));
				    	echo JHtml::_('select.genericlist', $productLayoutOption, $form_prefix.'[product_layout_id]', $attribs, 'value', 'text',$this->item->product_layout_id);
				    ?>

				<label>
					<input type="checkbox"  id="productLayout_config" onclick="configStore('productLayout_config','jformproduct_layout_id')" <?php echo ($this->item->use_config_layout_id==1 ? 'checked' : '')?>/>
						<?php  echo JText::_('COM_FLYCART_CONFIG_SETTING')?>
					</label>
						<input type="hidden" value="<?php echo $this->item->use_config_layout_id;?>" id="productLayout_config_text" name="<?php echo $form_prefix?>[use_config_layout_id]"/>
				</div>
			</div>

	</div>
</div>