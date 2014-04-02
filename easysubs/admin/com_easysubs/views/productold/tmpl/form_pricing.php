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

$form_prefix='jform[attribs][flycart]';
$groupprice_row=0;
$tierPrice_row=0;
$boolean=array(JHtml::_('select.option', '0', JText::_('COM_FLYCART_NO') ),
		JHtml::_('select.option', '1', JText::_('COM_FLYCART_YES') )
);


?>
<script>
function getTaxclass(taxable_value)
{
		if(taxable_value==1)
		{
			jQuery("#taxClass").show();
		}else{
			jQuery("#taxClass").hide();
			}

}
</script>
<input type="hidden" name="<?php echo $form_prefix ?>[flycart_product_id]" value="<?php echo $this->item->flycart_product_id; ?>" />

<input type="hidden" name="<?php echo $form_prefix ?>[store_id]" value="<?php echo ($this->item->store_id) ? $this->item->store_id : 1 ; ?>" />
<div class="row-fluid">
	<div class="span2">

	</div>
	<div class="span10">

		<!-- Product  Taxable -->
		<div class="control-group">
				<!-- Control Group for Product Tax charges  -->
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_REQUIRE_TAXABLE', array())?>
				<div class="controls">
					<?php
						$Taxatt=array('class'=>'control-group','id'=>'jformproductTaxable','size'=>'1','onchange'=>'javascript:getTaxclass(this.value)','title'=>'');
						echo JHtmlSelect::genericlist($boolean, $form_prefix.'[taxable]',$Taxatt, 'value', 'text',$this->item->taxable);?>
				</div>
		</div>
		<div class="control-group" id="taxClass" style="<?php echo ($this->item->taxable==1) ? 'display: block' : 'display: none' ;?>" >

			<!-- Control Group for Product Tax charges  -->
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_REQUIRE_TAX_CLASS', array())?>
				<div class="controls">
					<?php
							$taxClassOpt[] =JHtml::_('select.option',  '0', JText::_('COM_FLYCART_SELECT'));
						foreach($this->item->taxClass as  $taxClass)
						{
							$taxClassOpt[] =JHtml::_('select.option',  $taxClass->flycart_taxclass_id, JText::_($taxClass->taxclass_name));
						}
						echo JHtml::_('select.genericlist',$taxClassOpt, $form_prefix.'[taxclass]',null, 'value', 'text',$this->item->taxclass);?>

				</div>

		</div>

		<!-- Product Pricing -->
		<div class="control-group">
			<label for="jform[attribs][flycart][price]" class="control-label" ><?php echo JText::_('COM_FLYCART_PRODUCT_PRICE')?></label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">
					<?php	echo Flycart::currency()->getSymbol();?>
					</span>
					<input type="text" name="<?php echo $form_prefix; ?>[price]" id="jform_attribs_flycart_price" value="<?php echo $this->item->price;?>" />
				</div>
			</div>
		</div>

		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_GROUP_PRICE', array())?>
			<div class="controls">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?php echo JText::_('COM_FLYCART_CUSTOMER_GROUP');?></th>
							<th><?php echo JText::_('COM_FLYCART_GROUP_PRICE');?></th>
							<th><input type="button" class="btn btn-success" onclick="addGroupPrice()" value="<?php echo JText::_('COM_FLYCART_ADD');?>" /> </th>
						</tr>
					</thead>

					<tbody id="groupPriceTable">
					<?php if(($this->item->flycart_product_id)&&($this->item->group_price)):?>
						<?php foreach($this->item->group_price as $i=>$groupPriceList):?>
						<tr id="groupPrice<?php echo $groupprice_row;?>">
							<td>
								<input type="hidden" value="<?php echo $groupPriceList->flycart_product_groupprice_id;?>" name="<?php echo $form_prefix; ?>[group_price][<?php echo $groupprice_row; ?>][flycart_product_groupprice_id]"/>
								<?php	$cusGroup = array();
									foreach($this->userGroup as $a=>$userGroup)	{
										$cusGroup[] =JHtml::_('select.option', $userGroup->value, JText::_($userGroup->text));
									}
									echo JHtml::_('select.genericlist',$cusGroup, $form_prefix.'[group_price]['.$groupprice_row.'][customer_group_id]','', 'value', 'text', $groupPriceList->customer_group_id);
								?>
							</td>
							<td>
								<input type="text" class="input-mini" value="<?php echo $groupPriceList->customer_group_price;?>" name="<?php echo $form_prefix; ?>[group_price][<?php echo $groupprice_row?>][customer_group_price]"/>
							</td>
							<td><input type="button" class="btn btn-danger" onclick="orangeCartFormSubmit('orangecart.deletepricing.component.group.<?php echo $groupPriceList->flycart_product_groupprice_id;?>')" value="<?php echo JText::_('COM_FLYCART_DELETE');?>" /></td>
						</tr>
						<?php $groupprice_row++; ?>
						<?php endforeach;?>

					</tbody>
					<?php endif?>
				</table>
			</div>
		</div>
		<hr>
		<!-- Control group for  Special Price-->
		<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_SPECIAL_PRICE', $form_prefix.'[special_price]', $this->item->special_price,'text','special price', array('class'=>'input','required'=>'required'));?>

		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_SPECIAL_FROM_DATE', array());?>
			<div class="controls">
				<?php echo JHtml::calendar($this->item->special_from_date, 'jform[attribs][flycart][special_from_date]', 'form_attribs_flycart_special_from_date'); ?>
			</div>
		</div>
				<div class="control-group">
					<label for="jform[attribs][flycart][special_to_date]" class="control-label" ><?php echo JText::_('COM_FLYCART_PRODUCT_SPECIAL_TO_DATE')?></label>
					<div class="controls">
							<?php echo JHtml::calendar($this->item->special_to_date, 'jform[attribs][flycart][special_to_date]', 'form_attribs_flycart_special_to_date'); ?>
					</div>
				</div>

		<hr>
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_TIER_PRICE', array());?>
			<div class="controls">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?php echo JText::_('COM_FLYCART_CUSTOMER_GROUP');?></th>
							<th><?php echo JText::_('COM_FLYCART_TIER_PRICE');?></th>
							<th><?php echo JText::_('COM_FLYCART_PRODUCT_QUANTITY');?><p class="small"><?php echo JText::_('COM_FLYCART_TIER_PRICING_QTY_HELP');?></p></th>
							<th><a class="btn btn-success" onclick="addTierPrice()"><?php echo JText::_('COM_FLYCART_ADD');?></a></th>
						</tr>
					</thead>
					<tbody id="TierPriceTable">

					<?php
						if(($this->item->flycart_product_id) && ($this->item->tier_price)):

						foreach($this->item->tier_price as $tierPrice):?>
						<tr id="TierPrice<?php echo $tierPrice_row?>">
							<td>
								<input type="hidden" value="<?php echo $tierPrice->flycart_product_tierprice_id;?>" name="<?php echo $form_prefix;?>[tier_price][<?php echo $tierPrice_row?>][flycart_product_tierprice_id]"/>

								<?php	$cusGroup1 = array();
									foreach($this->userGroup as $userGroup)	{
										$cusGroup1[] =JHtml::_('select.option', $userGroup->value, JText::_($userGroup->text));
									}
									echo JHtml::_('select.genericlist',$cusGroup1, $form_prefix.'[tier_price]['.$tierPrice_row.'][customer_tier_id]','', 'value', 'text', $tierPrice->customer_tier_id);
								?>



							<td><input class="input-mini" type="text" placeholder="<?php echo JText::_('COM_ORANGECART_CUSTOMER_PRICE')?>" name="<?php echo $form_prefix;?>[tier_price][<?php echo $tierPrice_row?>][customer_tier_price]" class="input-mini" value="<?php echo $tierPrice->customer_tier_price;?>" required/></td>
							<td><input type="text" placeholder="<?php echo JText::_('COM_ORANGECART_TIER_TOTAL_QTY');?>" name="<?php echo $form_prefix;?>[tier_price][<?php echo $tierPrice_row?>][customer_tier_price_qty]" class="input-mini" value="<?php echo $tierPrice->customer_tier_price_qty;?>"  required/> </td>
							<td><input type="submit" class="btn btn-danger" onclick="orangeCartFormSubmit('orangecart.deletepricing.component.tier.<?php echo $tierPrice->flycart_product_tierprice_id;?>')" value="<?php echo JText::_('COM_FLYCART_DELETE');?>"/></td>
						</tr>
						<?php $tierPrice_row++;?>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

/** Assining the groupPrice tr id **/
var groupprice_row=<?php echo $groupprice_row;?>;

/** Assining the tierPrice tr id **/
var tierPrice_row=<?php echo $tierPrice_row;?>;

/**
  * Method to append table row for adding group Price
  */

function addGroupPrice()
{
	  (function($){
		  html='<tr id="GroupPrice'+groupprice_row+'">';
		  html+='<input type="hidden" name="<?php echo $form_prefix;?>[group_price]['+ groupprice_row+'][flycart_product_groupprice_id]"><td><select class="text text-info" name="<?php echo $form_prefix ?>[group_price][' + groupprice_row + '][customer_group_id]" >';
		  <?php foreach($this->userGroup as $user) :?>
		  html+='<option value="<?php echo $user->value; ?>"><?php echo $user->text;?></option>';
		  <?php endforeach;?>
		  html+='</select></td>';
		  html+='<td><input type="text" placeholder="<?php echo JText::_('COM_FLYCART_GROUP_PRICE')?>" name="<?php echo $form_prefix ?>[group_price][' + groupprice_row + '][customer_group_price]" class="input-mini"/></td>';
		  html+='<td><input type="button" class="btn btn-danger" onclick="removeGroupPrice('+groupprice_row+')" value="<?php echo JText::_('COM_FLYCART_DELETE');?>" /></td></tr>';
		 flycart.jQuery('#groupPriceTable').append(html);

	 	groupprice_row++;

	  })(flycart.jQuery);
}

/**
  * Method to append table row for adding group Price
  */
function addTierPrice()
{

	  (function($){
		html='<tr id="TierPrice'+tierPrice_row+'">';
		html+='<input type="hidden" name="<?php echo $form_prefix;?>[tier_price]['+tierPrice_row+'][flycart_product_tierprice_id]" />';
		html+='<td><select class="input" name="<?php echo $form_prefix;?>[tier_price]['+tierPrice_row+'][customer_tier_id]">';
		<?php foreach($this->userGroup as $user) :?>
		html+='<option value="<?php echo $user->value; ?>"><?php echo $user->text;?></option>';
		<?php endforeach;?>
		html+='</select></td>';
		html+='<td><input type="text" placeholder="<?php echo JText::_('COM_FLYCART_TIER_PRICE')?>" name="<?php echo $form_prefix;?>[tier_price]['+tierPrice_row+'][customer_tier_price]" class="input-mini" /></td>';
		html+='<td><input type="text" placeholder="<?php echo JText::_('COM_FLYCART_QUANTITY')?>" name="<?php echo $form_prefix;?>[tier_price]['+tierPrice_row+'][customer_tier_price_qty]" class="input-mini" /></td>';
		html+='<td><input type="button" class="btn btn-danger" onclick="removeTierPrice('+tierPrice_row+')" value="<?php echo JText::_('COM_FLYCART_DELETE');?>" /></td></tr>';
		jQuery('#TierPriceTable').append(html);
		tierPrice_row++;
	  })(flycart.jQuery);
}


/**
  * Method to append table row for Remove group Price
  */
function removeGroupPrice(a)
{
	  (function($){
	flycart.jQuery('#GroupPrice'+a).remove();
	  })(flycart.jQuery);
}

/**
  * Method to append table row for Remove group Price
  */
function removeTierPrice(a)
{
	(function($){
		flycart.jQuery('#TierPrice'+a).remove();
	})(flycart.jQuery);
}

function addSpecialPrice()
{
	(function($){
		flycart.jQuery('#specialPrice').show();
		flycart.jQuery('#addSepcialPriceBtn').hide();
	})
}

</script>