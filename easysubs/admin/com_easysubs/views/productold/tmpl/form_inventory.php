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

$form_prefix='jform[attribs][flycart]';
$boolean=array(JHtml::_('select.option', '0', JText::_('COM_FLYCART_NO') ),
										 JHtml::_('select.option', '1', JText::_('COM_FLYCART_YES') )
										);
$model = FOFModel::getTmpInstance('Products', 'FlycartModel');


?>



<script type="text/javascript">
/**
 * Method to choose the store config value based on the
 * Checkbox checked or unchecked
 * @params checkboxId type string,inputId type string
 */

function configStore(checkboxId,inputId)
{


	(function($){
		if(flycart.jQuery('#'+checkboxId).attr('checked'))
		{
			flycart.jQuery('#'+inputId).prop("disabled",true);
			flycart.jQuery('#'+checkboxId).val(1);
			flycart.jQuery('#'+checkboxId+'_text').val(1);

		}else{
			flycart.jQuery('#'+inputId).prop("disabled",false);
			flycart.jQuery('#'+checkboxId).val(0);
			flycart.jQuery('#'+checkboxId+'_text').val(0);
			}

	})(flycart.jQuery);
	}


</script>

<div class="row-fluid">
<div class="span2">

</div>
	<div class="span10">

		<!-- Product Sku -->
		<div class="control-group">
			<label for="<?php echo $form_prefix; ?>[sku]" class="control-label" ><?php echo JText::_('COM_FLYCART_PRODUCT_SKU')?></label>
			<div class="controls">
				<input type="text" name="<?php echo $form_prefix; ?>[sku]" id="jform_attribs_flycart_sku" value="<?php echo $this->item->sku;?>" />
			</div>
		</div>



		<!-- Product Mange Stock -->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_MANAGE_STOCK', array());?>
			<div class="controls">
				<?php echo JHtml::_('select.genericlist',$boolean,$form_prefix.'[manage_stock]', null, 'value', 'text',$this->item->use_config_manage_stock ==1 ? Flycart::config('manage_stock') :$this->item->use_config_manage_stock,'storeManageStock');?>
				<!--
				<label><input type="checkbox" id="manageStock_config" onclick="configStore('manageStock_config','storeManageStock')" <?php echo ($this->item->use_config_manage_stock==1 ? 'checked' : '')?> /><?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?></label>
				<input type="hidden" value="<?php // echo $this->item->use_config_notify_qty;?>" id="manageStock_config_text"   name="<?php echo $form_prefix?>[use_config_manage_stock]" />
				-->
			</div>
		</div>

		<!-- Control Group For Min Stock Qty -->

		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_MINIMUM_STOCK_ALLOWED_IN_CART', array())?>
			<div class="controls">
				<input id="min_stock_qty" type="text" name="<?php echo $form_prefix?>[min_stock_qty]" value="<?php echo($this->item->use_config_min_stock ==1 ? Flycart::config('min_stock_qty') :$this->item->min_stock_qty); ?>" <?php echo ($this->item->use_config_min_stock==1 ? 'disabled' : '')?> />
				<label>
					<input type="checkbox"  id="minStock_config" onclick="configStore('minStock_config','min_stock_qty')" <?php echo ($this->item->use_config_min_stock==1 ? 'checked' : '')?>/>
						<?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?>
					</label>
				<input type="hidden" value="<?php echo $this->item->use_config_min_stock;?>" id="minStock_config_text" name="<?php echo $form_prefix?>[use_config_min_stock]"/>

			</div>
		</div>

		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_MAXIMUM_STOCK_ALLOWED_IN_CART', array())?>
			<div class="controls">
				<input id="max_stock_qty" type="text" name="<?php echo $form_prefix?>[max_stock_qty]" value="<?php echo ($this->item->use_config_max_stock ==1 ? Flycart::config('max_stock_qty'):$this->item->max_stock_qty);?>"  <?php echo ($this->item->use_config_max_stock==1 ? 'disabled' : '')?>/>
				<label>
					<input  value="<?php echo $this->item->use_config_max_stock;?>" type="checkbox" id="maxStock_config" onclick="configStore('maxStock_config','max_stock_qty')" <?php echo ($this->item->use_config_max_stock==1 ? 'checked' : '')?>/>
					<?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?>
					<input type="hidden" value="<?php echo $this->item->use_config_max_stock;?>" id="maxStock_config_text"  name="<?php echo $form_prefix?>[use_config_max_stock]"/>
				</label>
			</div>
		</div>

		<!-- Control Group for Minium sales qty -->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_MINIMUM_SALES_QTY', array())?>
			<div class="controls">
				<input id="min_sale_qty" type="text" name="<?php echo $form_prefix?>[min_sale_qty]" value="<?php echo ($this->item->use_config_min_sale ==1 ? Flycart::config('min_sale_qty'): $this->item->min_sale_qty);?>" <?php echo ($this->item->use_config_min_sale==1 ? 'disabled' : '')?>/>
				<label><input  type="checkbox" value="<?php echo $this->item->use_config_min_sale;?>"  id="minSale_config" onclick="configStore('minSale_config','min_sale_qty')" <?php echo ($this->item->use_config_min_sale==1 ? 'checked' : '')?>/><?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?></label>
				<input type="hidden" value="<?php echo $this->item->use_config_min_sale;?>" id="minSale_config_text"  name="<?php echo $form_prefix?>[use_config_min_sale]"/>
			</div>
		</div>
		<!-- Control Group for Minium sales qty -->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_MAXIMUM_SALES_QTY', array())?>
			<div class="controls">
				<input id="max_sale_qty" type="text" name="<?php echo $form_prefix?>[max_sale_qty]" value="<?php echo ($this->item->use_config_max_sale==1?Flycart::config('max_sale_qty'):$this->item->max_sale_qty) ;?>" <?php echo ($this->item->use_config_max_sale==1 ? 'disabled' : '')?> />
				<label><input type="checkbox" value="<?php echo $this->item->use_config_max_sale;?>" name="<?php echo $form_prefix?>[use_config_max_sale]"  id="maxSale_config" onclick="configStore('maxSale_config','max_sale_qty')" <?php echo ($this->item->use_config_max_sale==1 ? 'checked' : '')?> /><?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?></label>
				<input type="hidden" value="<?php echo $this->item->use_config_max_sale;?>" id="maxSale_config_text"  name="<?php echo $form_prefix?>[use_config_max_sale]"/>
			</div>
		</div>

		<!-- Control Group for Notify below qty -->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_NOTIFY_BELOW_QTY', array())?>
			<div class="controls">
				<input id="notify_qty" type="text" name="<?php echo $form_prefix?>[notify_qty]" value="<?php echo ($this->item->use_config_notify_qty==1 ? Flycart::config('notify_below_qty'): $this->item->notify_qty);?>" <?php echo ($this->item->use_config_notify_qty==1 ? 'disabled' : '')?> />
				<label><input type="checkbox" value="<?php echo $this->item->use_config_notify_qty;?>" id="notify_qty_config" onclick="configStore('notify_qty_config','notify_qty')" <?php echo ($this->item->use_config_notify_qty==1 ? 'checked' : '')?> /><?php echo JText::_('COM_FLYCART_CONFIG_SETTING')?></label>
				<input type="hidden" value="<?php echo $this->item->use_config_notify_qty;?>" id="notify_qty_config_text"   name="<?php echo $form_prefix?>[use_config_notify_qty]" />
			</div>
		</div>

		<!-- Control group for Product Quantity -->
		<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_QUANTITY', $form_prefix.'[qty]',$this->item->qty, 'text','SKU459',array('class'=>'input','required'=>'required'))?>


		<div class="control-group">
			<!-- Control group for Product Backorders  -->
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_REQUIRE_BACKORDERS', array());?>
			<div class="controls">
				<?php echo JHtml::_('select.genericlist',$boolean,$form_prefix.'[allow_backorder]', null, 'value', 'text', $this->item->allow_backorder);?>
			</div>
		</div>
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_STOCK_AVAILABILITY', array())?>
			<div class="controls">
				<?php $stockAvail=array(JHtml::_('select.option', '0', JText::_('COM_FLYCART_PRODUCT_OUT_OF_STOCK')),JHtml::_('select.option', '1', JText::_('COM_FLYCART_PRODUCT_INSTOCK') ));
				echo JHtml::_('select.genericlist',$stockAvail,$form_prefix.'[stock_status]', null, 'value', 'text', $this->item->stock_status);?>
			</div>

		</div>
	</div>
</div>