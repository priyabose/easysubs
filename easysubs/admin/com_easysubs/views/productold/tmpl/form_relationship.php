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

$model = FOFModel::getTmpInstance('Products', 'FlycartModel');
$form_prefix='jform[attribs][flycart]';
?>

<div class="row-fluid">
	<div class="span2">
	</div>
	<div class="span10">
		<div class="control-group">
		<!-- Control group for product Up sells Starts here -->
		<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_UP_SELLS', array())?>

		<div class="controls">
			<?php
				$selected_product_up_sells=explode(',',$this->item->product_up_sells);
				foreach($this->item->productList as $plist):
					$productOption1[] = JHTML::_('select.option',$plist->flycart_product_id,$model->getcontentData($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id,'title'));
				endforeach;
				echo JHTML::_('select.genericlist', $productOption1,$form_prefix.'[product_up_sells]','class="input-xlarge" multiple="multiple"', 'value','text',$selected_product_up_sells);
				?>

		<input class="input-mini" type="text" id="product_up_sells" name="<?php echo $form_prefix;?>[product_up_sells]" value="<?php echo $this->item->product_up_sells?>" style="display:none;"/>
		<p><?php echo JText::_('COM_FLYCART_CHOOSE_UP_SELLING_PRODUCT');?> <a  href="#allProductUpsells" onclick="clearPid()" role="button" data-toggle="modal"><?php echo JText::_('COM_FLYCART_CLICK_HERE');?></a></p>

				<!--  model to load all product details -->
				<div id="allProductUpsells" class="modal hide fade">

				    <div class="modal-header">
		 				 <span class="pull-right"><button class="btn btn-mini" data-dismiss="modal" aria-hidden="true">&times;</button></span>
							<h3><?php echo JText::_('COM_FLYCART_PRODUCTS');?></h3>
					   <input class="input-xlarge" id="searchInput1" type='text' placeholder='filter products' />
					</div>

					<div class="modal-body">
						<table class="table table-striped">
							<thead>
								<th><input type="checkbox" name="jform[product_id]"></th>
								<th><?php echo JText::_('COM_FLYCART_PRODUCT_NAME')?></th>
								<th><?php echo JText::_('COM_FLYCART_PRODUCT_PRICE')?></th>
							</thead>

							<tbody id="pUpsells">
								<?php foreach($this->item->productList as $plist):?>
								<tr id="pList_product_up_sells<?php echo $plist->flycart_product_id;?>">
									<td><input onclick="addPid(<?php echo $plist->flycart_product_id;?>,'product_up_sells')" type="checkbox" value="<?php echo $plist->flycart_product_id;?>"></td>
									<td><?php  echo $model->getcontentData($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id,'title');?></td>
									<td><?php echo $plist->price;?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
			    	</div>
			    	<div class="modal-footer">
				   		<a class="btn btn-save" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_SAVE')?></a>
				   		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_CANCEL')?></button>
			    	</div>
		 		</div>
			</div>
		</div><!-- Control group for product Up sells Starts here -->
		<hr>
		<!-- Control Group for Product Cross Sells Start here -->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_CROSS_SELLS', array())?>
				<div class="controls">
					<?php
						$selected_product_cross_sells=explode(',',$this->item->product_cross_sells);
							foreach($this->item->productList as $plist):
							$productOption2[] = JHTML::_('select.option',$plist->flycart_product_id,$model->getcontentData($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id,'title'));
							endforeach;
							echo JHTML::_('select.genericlist', $productOption2,$form_prefix.'[product_cross_sells]',  'class="input-xlarge"  multiple="multiple"' ,'value','text',$selected_product_cross_sells);?>
					<input  class="input-mini" type="text" id="product_cross_sells"  name="<?php echo $form_prefix?>[product_cross_sells]" value="<?php echo $this->item->product_cross_sells?>" style="display:none;" />
					<p><?php echo JText::_('COM_FLYCART_CHOOSE_CROSS_SELLING_PRODUCT');?> <a href="#allProductCrosssells" role="button" onclick="clearPid()" data-toggle="modal"><?php echo JText::_('COM_FLYCART_CLICK_HERE');?></a></p>

						<!--  model to load all product details -->
					    <div id="allProductCrosssells" class="modal hide fade">
							<div class="modal-header">
								<span class="pull-right"><button class="btn btn-mini" data-dismiss="modal" aria-hidden="true">&times;</button></span>
									<h3><?php echo JText::_('COM_FLYCART_PRODUCTS');?></h3>
							    	<input  class="input-xlarge" id="searchInput3" type='text' placeholder='filter products' />
							</div>
							<div class="modal-body">
								<table class="table table-striped">
									<thead>
										<th><input type="checkbox" name="jform[product_id]"></th>
										<th><?php echo JText::_('COM_FLYCART_PRODUCT_NAME')?></th>
										<th><?php echo JText::_('COM_FLYCART_PRODUCT_PRICE')?></th>
									</thead>
									<tbody id="pCrosssells">
										<?php foreach($this->item->productList as $plist):?>
										<tr id="pListproduct_cross_sells<?php echo $plist->flycart_product_id;?>">
											<td><input onclick="addPid(<?php echo $plist->flycart_product_id;?>,'product_cross_sells')" type="checkbox" value="<?php echo $plist->flycart_product_id;?>"></td>
											<td><?php echo $model->getcontentData($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id,'title');?></td>
											<td><?php echo $plist->price;?></td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
				    		</div>
							<div class="modal-footer">
								<a class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_SAVE')?></a>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_CANCEL')?></button>
							</div>
	   			</div><!-- Product Cross Sells Ends here -->
			</div>
		</div><!-- Control Group  Product Down sells starts here -->
		<hr>
		<!--Control group for Product down sells Starts here  -->
		<div class="control-group">
			<!-- Label for Product _down sells -->
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_DOWN_SELLS', array());?>

			<!--  Input for storing comma seperated ids -->
			<div class="controls">
				<?php
						$selected_product_down_sells=explode(',',$this->item->product_down_sells);

						foreach($this->item->productList as $plist):
								$productOption3[] = JHTML::_('select.option',$plist->flycart_product_id,JText::_($model->getProductTitle($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id)));
						endforeach;
						echo JHTML::_('select.genericlist', $productOption2,$form_prefix.'[product_down_sells]',  'class="input-xlarge"  multiple="multiple"' ,'value','text',$selected_product_down_sells);
				?>
				<input class="input-mini" type="text" id="product_down_sells" name="<?php echo $form_prefix?>[product_down_sells]" value="<?php echo $this->item->product_down_sells?>" style="display:none;"/>

				<p> <?php echo JText::_('COM_FLYCART_CHOOSE_DOWN_SELLING_PRODUCT');?> <a href="#allProductDownsells" role="button" onclick="clearPid()" data-toggle="modal"><?php echo JText::_('COM_FLYCART_CLICK_HERE');?></a>

					<!-- model to load all product details -->
			    	<div id="allProductDownsells" class="modal hide fade">

			    		<div class="modal-header">
							<span class="pull-right"><button class="btn btn-mini" data-dismiss="modal" aria-hidden="true">&times;</button></span>
						    	<h3><?php echo JText::_('COM_FLYCART_PRODUCTS');?></h3>

						    	<!-- Filter Text box -->
						    	<input id="searchInput2" class="input-xlarge" type="text" placeholder="filter products" />
						</div>

						<div class="modal-body">
							<table class="table table-striped">
								<thead>
									<th><input type="checkbox" name="jform[product_id]"></th>
									<th><?php echo JText::_('COM_FLYCART_PRODUCT_NAME')?></th>
									<th><?php echo JText::_('COM_FLYCART_PRODUCT_PRICE')?></th>
								</thead>

								<tbody id="pDownsells">
									<?php foreach($this->item->productList as $plist):?>
									<tr id="pListproduct_down_sells<?php echo $plist->flycart_product_id;?>">
										<td><input onclick="addPid(<?php echo $plist->flycart_product_id;?>,'product_down_sells')" type="checkbox" value="<?php echo $plist->flycart_product_id;?>"></td>
										<td><?php echo $model->getcontentData($plist->flycart_product_id,$plist->catalog_source,$plist->catalog_source_id,'title');?></td>
										<td><?php echo $plist->price;?></td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					    <div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_SAVE')?></a>
						    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_FLYCART_CANCEL')?></button>
						</div>
					</div><!-- model to load all product details Down Sells Ends here -->
			</div><!-- control ends here -->
		</div><!--Control group for Product down sells Starts here  -->

	</div><!-- Span8 Ends here -->

</div><!-- Row Ends here -->

<script type="text/javascript">
var i;
var pids=[];
/**
 * Method to add the selected product ids into the array
 * @params product id type int product name type string
 *
 */
function addPid(pid,pname)
{
	pids.push(pid);
	var x=document.getElementById("product_up_sells");
	x.innerHTML=pids.join();
	console.log(pids);
	(function($){
		flycart.jQuery("#"+pname).val(x.innerHTML);
	})(flycart.jQuery);
}
/**
 * Method to clear the Product Ids in the array
 */
function clearPid()
{
	pids.length = 0;
}

/**
 * Method to Search the product name based
 */
(function($){
	flycart.jQuery(function(){ // this will be called when the DOM is ready
		flycart.jQuery('#searchInput1').keyup(function() {
		      if (this.value.length) {
		        var that = this;
		        console.log(this);
		        flycart.jQuery("#pUpsells tr").hide().filter(function() {
		            return flycart.jQuery(this).html().toLowerCase().indexOf(that.value.toLowerCase()) !== -1;
		        }).show();
		        flycart.jQuery("#pUpsells").show();
		    } else {
		    	flycart.jQuery("#pUpsells").show();
		    }
		  });

		flycart.jQuery('#searchInput2').keyup(function() {
		      if (this.value.length) {
		        var that = this;
		        console.log(this);
		        flycart.jQuery("#pDownsells tr").hide().filter(function() {
		            return jQuery(this).html().toLowerCase().indexOf(that.value.toLowerCase()) !== -1;
		        }).show();
		        flycart.jQuery("#pDownsells").show();
		    } else {
		    	flycart.jQuery("#pDownsells").show();
		    }
		  });


		flycart.jQuery('#searchInput3').keyup(function() {
		      if (this.value.length) {
		        var that = this;
		        console.log(this);
		        flycart.jQuery("#pCrosssells tr").hide().filter(function() {
		            return flycart.jQuery(this).html().toLowerCase().indexOf(that.value.toLowerCase()) !== -1;
		        }).show();
		        flycart.jQuery("#pCrosssells").show();
		    } else {
		    	flycart.jQuery("#pCrosssells").show();
		    }
		  });



		});
})(flycart.jQuery);


</script>

















