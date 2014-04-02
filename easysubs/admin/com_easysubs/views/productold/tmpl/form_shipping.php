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
$boolean=array(JHtml::_('select.option', '1', JText::_('COM_FLYCART_YES') ),
		JHtml::_('select.option', '0', JText::_('COM_FLYCART_NO') )
);
?>

<div class="row-fluid">
	<div class="span2">
	</div>
<!-- Div for Product Dimensions -->
	<div class="span10">

		<div class="control-group">
			<!--  control group Require shipping -->
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_REQUIRE_SHIPPING', array())?>
			<div class="controls">
				<?php echo JHtml::_('select.genericlist',$boolean,$form_prefix.'[shippable]', null, 'value', 'text', $this->item->shippable);?>
			</div>
		</div>
		<hr>
		<h5><?php echo JText::_('COM_FLYCART_PRODUCT_DIMENSIONS');?></h5>
			<!-- Product Width -->
			<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_WIDTH',$form_prefix.'[width]',$this->item->width,'text','',array('class'=>'input','required'=>'required'));?>
			<!-- Product height -->

			<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_HEIGHT',$form_prefix.'[height]',$this->item->height,'text','',array('class'=>'input','required'=>'required'));?>

			<div class="control-group">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_LENGTH',$options=array());?>

				<div class="controls">
					<table>
						<tr>
							<td>
								<input type="text" name="<?php echo $form_prefix;?>[length]" value="<?php echo $this->item->length;?>" required/>
							</td>
							<td>
							<?php

								foreach($this->item->lengthList as $length){
								$lengthOption[] = JHTML::_('select.option',$length->flycart_length_id,JText::_($length->length_title));
								}
								echo JHTML::_('select.genericlist', $lengthOption,$form_prefix.'[length_id]',  'class="inputbox required"' ,'value','text',$this->item->length_id);
							?>
							</td>
						</tr>
						</table>
				</div>
			</div>



		<!-- Lenght Control Group Ends here -->

		<div class="control-group">
			<?php echo  FlycartInput::getLabel('COM_FLYCART_PRODUCT_WEIGHT',$options=array());?>
			<div class="controls">
				<table>
				<tr>
					<td>
						<input type="text" name="<?php echo $form_prefix;?>[weight]" value="<?php echo $this->item->weight;?>" required/>
					</td>
					<td>
				<?php
				foreach($this->item->weightList as $weight):
				$weightOption[] = JHTML::_('select.option',$weight->flycart_weight_id,JText::_($weight->weight_title));
				endforeach;
				echo JHTML::_('select.genericlist', $weightOption,$form_prefix.'[weight_id]',  'class="inputbox required"' ,'value','text',$this->item->weight_id);
				?>
				</td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</div><!-- Row ends here -->

