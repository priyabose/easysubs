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

//FOFTemplateUtils::addJS('media://flycart/assets/flycartjui.js');
$option_boolen=array(JHtml::_('select.option', '1', JText::_('COM_FLYCART_YES') ),
										 JHtml::_('select.option', '0', JText::_('COM_FLYCART_NO') )
										);
$option_type =array(JHTML::_('select.option', '',JText::_('COM_FLYCART_CHOOSE')),JHTML::_('select.optgroup', 'Input'), JHTML::_('select.option', 'text',JText::_('COM_FLYCART_SELECT_TYPE_TEXT')),
 JHTML::_('select.option', 'textarea',JText::_('COM_FLYCART_SELECT_TYPE_TEXTAREA')),
 JHTML::_('select.optgroup', 'Choose'),JHTML::_('select.option', 'select',JText::_('COM_FLYCART_SELECT_TYPE_DROPDOWN')),
 JHTML::_('select.option', 'radio',JText::_('COM_FLYCART_SELECT_TYPE_RADIO')),
 JHTML::_('select.option', 'checkbox',JText::_('COM_FLYCART_SELECT_TYPE_CHECKBOX')),
 JHTML::_('select.optgroup', 'Date'),JHTML::_('select.option', 'date',JText::_('COM_FLYCART_SELECT_TYPE_DATE')),
 JHTML::_('select.option', 'time',JText::_('COM_FLYCART_SELECT_TYPE_TIME')),
 JHTML::_('select.option', 'datetime',JText::_('COM_FLYCART_SELECT_TYPE_DATE_TIME')),
 JHTML::_('select.optgroup', 'File'),JHTML::_('select.option', 'file',JText::_('COM_FLYCART_SELECT_TYPE_FILE'))
 );
 $POption_row=0;
 $optionvalue_row=0;
?>


<div class="row-fluid">
	<div class="span2">
	</div>
	<div class="span10">
		<div class="pull-right">
				<input class="btn btn-success" id="addOptionBtn" type="button" onclick="addOptionControl()" value="<?php echo JText::_('COM_FLYCART_ADD_NEW_OPTION')?>"/></li>
		</div>
		<hr>
		<div id="PControl">
		</div>


	</div>
</div>

<div class="row-fluid">
	<div class="span2">
	</div>
	<div class="span10">

		<table class="table table-bordered">
			<tr>
				<th><?php echo JText::_('COM_FLYCART_OPTION_TITLE');?></th>
				<th><?php echo JText::_('COM_FLYCART_OPTION_TYPE');?></th>
				<th><?php echo JText::_('COM_FLYCART_OPTION_REQUIRED');?></th>
			</tr>
				<tbody>
					<?php
							if(($this->item->flycart_product_id) && ($this->item->optionList)):
						foreach($this->item->optionList as $Option):?>
						<tr id="ProductOption<?php echo $POption_row?>">
							<td><input type="hidden" name="<?php echo $form_prefix?>[product_option][<?php echo $POption_row?>][flycart_product_option_id]" value="<?php echo $Option->flycart_product_option_id ;?>" />
								<input type="text" class="input-mini" name="<?php echo $form_prefix?>[product_option][<?php echo $POption_row?>][option_name]" value="<?php echo $Option->option_name; ?>"/>
									<a class="modal" rel="{handler:'iframe',size:{x: window.innerWidth-80, y: window.innerHeight-80}}"
							 		href="index.php?option=com_flycart&view=product_optionvalues&tmpl=component&product_option_id=<?php echo $Option->flycart_product_option_id ;?>"    style="<?php  if(($Option->option_type=='select') ||($Option->option_type=='radio') || ($Option->option_type=='checkbox')){ echo $display='display:block;';}else { echo $display='display:none;';}?>" >
										<span> 	<?php echo JText::_('COM_FLYCART_PRODUCT_OPTION_VALUES')?></span>
										</a>
								</td>
							<td>
									<?php
										$attribs = array('class' => 'inputbox', 'id' => 'option_type'.$POption_row, 'size'=>'1', 'title'=>JText::_('MOD_EXAM_SELECT_AN_OPTION'));
											echo JHtml::_('select.genericlist',$option_type,$form_prefix.'[product_option]['.$POption_row.'][option_type]', $attribs, 'value', 'text',$Option->option_type);?></td>
							<td><?php echo JHtml::_('select.genericlist',$option_boolen,$form_prefix.'[product_option]['.$POption_row.'][option_required]', null, 'value', 'text',$Option->option_required);?></td>

							<td><a onclick="deleteOption(<?php echo $Option->flycart_product_option_id ;?>,<?php echo $POption_row;?>)"><i class="icon-trash"></i></a></td>
						</tr>
						<?php $POption_row ++;?>
						<?php endforeach;
								endif;
						?>
				</tbody>
		</table>

	</div>
</div>


<script type="text/javascript">


var POption_row=<?php echo $POption_row;?>;
var option_value=0;
var Value_row=1;

/**
 * Method to add Option Control group
 * @returns appended html
 */
 function addOptionControl()
	{

		(function($){

		html='<div id="OptionGroup'+POption_row+'">';

		html+='<table class="table table-bordered"><tbody><tr>';

		html+='<td><input placeholder="<?php echo JText::_('COM_FLYCART_OPTION_NAME_PLACHOLDER')?>" class="input-small" id="optionTitle'+POption_row+'" type="text" name="<?php echo $form_prefix;?>[product_option]['+POption_row+'][option_name]" required />';

		html+='<td><select id="optionType'+POption_row+'" onchange="javascript:addOptionValue(this.value,'+POption_row +')" name="<?php echo $form_prefix?>[product_option]['+POption_row+'][option_type]" >';

		html+='<option>Select Option Type</option><optgroup label="Input"><option value="text">Text</option>';

		html+='<option value="textarea">Textarea</option></optgroup><optgroup label="Choose"><option value="select">Dropdown</option>';

		html+='<option value="radio">Radio</option><option value="checkbox">Checkbox</option></optgroup>';

		html+='<optgroup label="Date"><option value="date">Date</option><option value="time">Time</option>';

		html+='<option value="datetime">Date Time</option></optgroup><optgroup label="File"><option value="file">File</option></optgroup></select></td>';

		html+='<td><select id="optionRequired'+POption_row+'"  name="<?php echo $form_prefix?>[product_option]['+POption_row +'][option_required]" required>';

		html+='<option selected="selected" value="1">Yes</option><option value="0">No</option></select>';

		html+='</td><td><input id="optionid'+POption_row+'" type="hidden" name="<?php echo $form_prefix;?>[product_option]['+POption_row+'][flycart_product_option_id]"/>';

		html+='<i class="icon-trash" onclick="removeOptionGroup(\'OptionGroup'+POption_row +'\')"></i></td></tr></tbody></table>';
		flycart.jQuery("#PControl").append(html);

		POption_row++;

	})(flycart.jQuery);
	}

	/**
	  * Method to remove the appended table row
	  * @params row_id type string
	  */

	function removeOptionGroup(row_id)
	{
		(function($){
			flycart.jQuery("#"+row_id).remove();
		})(flycart.jQuery);
	};

	/**
	 *  Method to Delete the Product Option row
	 *  @params product Optio id type int, row_id type string
	 *  @returns data
	 */

	function deleteOption(product_option_id,row_id)
	{
			(function($){
		flycart.jQuery.ajax({
			type :'post',
			url :'index.php?option=com_flycart&view=options&task=deleteProductOption',
			 data:{'flycart_product_option_id':product_option_id},
			dataType : 'json',
			success : function(data) {
				jQuery("#ProductOption"+row_id).remove();
				}
			});

			})(flycart.jQuery);
	}



</script>

