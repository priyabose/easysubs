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
$boolean=array(JHtml::_('select.option', '0', JText::_('COM_FLYCART_NO') ),
		JHtml::_('select.option', '1', JText::_('COM_FLYCART_YES') )
);

$model = FOFModel::getTmpInstance('Products', 'FlycartModel');
$layouts=$model->getLayoutType('product');


?>



	<div class="row-fluid">
		<div class="span2">

		</div>
		<div class="span10">

			<div class="flycart-product-general">

				<?php if($catalog_source=='com_flycart'):?>
				<div class="control-group">
					<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_NAME', array())?>
					<div class="controls">
						<input type="text" name="<?php echo $form_prefix; ?>[title]" id="jform_attribs_flycart_sku" value="<?php echo $this->item->title;?>" />
					</div>
				</div>
				<div class="control-group">
					<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_SDESC', array())?>
					<div class="controls">

						<textarea rows="3" name="<?php echo $form_prefix; ?>[product_short_desc]"> <?php echo $this->item->product_short_desc;?></textarea>
					</div>
				</div>

				<div class="control-group">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_LDESC', array())?>
					<div class="controls">
					<?php
							 /**  get the Joomla's Editor  Object */
							 $editor = JFactory::getEditor();

							 /** Call the Display Method in the Editor Class  */
							$text_editor=$editor->display($form_prefix.'[product_long_desc]', $this->item->product_long_desc, '550', '300', '60', '20',  true);
							echo $text_editor;	?>

					</div>
				</div>
			<?php endif;?>

			<?php if($catalog_source=='com_flycart'):?>
				<div class="control-group" for="product_cat">
					<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_CATEGORIES', array())?>
					<div class="controls">
						<?php

								foreach($this->categories as $cat):
									$cat_tagOption[] = JHTML::_('select.option',$cat->value,$cat->text);
								endforeach;
						echo JHTML::_('select.genericlist', $cat_tagOption,$form_prefix.'[catid]','class="input-xlarge"', 'value','text',$this->item->catid);

						?>

					</div>

				</div>
				<div class="control-group" for="product_tag">
					<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_TAG', array())?>
					<div class="controls">
						<?php

							$product_tag=explode(',',$this->item->tag_id);

								foreach($this->tags as $tag):
									$product_tagOption[] = JHTML::_('select.option',$tag->value,$tag->text);
								endforeach;
						echo JHTML::_('select.genericlist', $product_tagOption,$form_prefix.'[tag_id][]','class="input-xlarge" multiple="multiple"', 'value','text',$product_tag);

						?>

					</div>
				</div>

				<!-- TO DISPLAY METAKEYWORDS -->
				<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_METAKEY', $form_prefix.'[product_metakey]', $this->item->product_metakey, 'text', '', array('class'=>'input-xlarge','required'=>''))?>

				<?php echo FlycartInput::getControlGroup('COM_FLYCART_PRODUCT_METADESC', $form_prefix.'[product_metadesc]', $this->item->product_metadesc, 'text', '', array('class'=>'input-xlarge','required'=>''))?>

				<div class="control-group">
					<?php echo FlycartInput::getLabel('COM_FLYCART_ENABLE_PRODUCT', array())?>
						<div class="controls">

						<?php	$arr1 = array(JHtml::_('select.option', '1', JText::_('COM_FLYCART_ENABLE') ),
								JHtml::_('select.option', '0', JText::_('COM_FLYCART_DISABLE') )	);
						echo JHtml::_('select.genericlist',$arr1,$form_prefix.'[enabled]',null, 'value', 'text',($this->item->enabled)? $this->item->enabled :0);?>
					</div>
				</div>


				<?php endif;?>

			</div>

		</div>
	</div>


