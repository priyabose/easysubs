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
JHTML::_('behavior.modal');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

?>
<?php
$additional_image=json_decode($this->item->product_additional_images);

?>

<!-- jInsertFieldValue('', 'jform_images_image_intro1'); return false; -->
<div class="row-fluid">
	<div class="span2">
	</div>
	<div class="span10">
		<div class="control-group">
			<div class="control-label">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_INTRO_IMAGE', array());?>
				<div class="controls">
					<div class="input-prepend input-append">
						<div class="media-preview add-on">
						<span class="hasTipPreview" title="">
							<i class="icon-eye"></i>
						</span>
						</div>
						<input id="jform_images_image_intro1" class="input" value="<?php echo $this->item->product_main_image;?>" type="text" readonly="readonly"  name="<?php echo $form_prefix?>[product_main_image]" />
						<a class="modal btn" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&fieldid=jform_images_image_intro1&folder=" title="Select"> Select</a>
							<a class="btn hasTooltip" onclick="jInsertFieldValue('', 'jform_images_image_intro1');return false;"  href="#" title="" data-original-title="Clear">
							<i class="icon-remove"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="control-group">
			<div class="control-label">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_ALTER_IMAGE_1', array());?>
				<div class="controls">
					<div class="input-prepend input-append">
					<div class="media-preview add-on">
						<span class="hasTipPreview" title="">
						<i class="icon-eye"></i>
						</span>
					</div>
						<input id="jform_images_image_alt1" class="input" value="<?php echo $additional_image[0];?>"  type="text" readonly="readonly"  name="<?php echo $form_prefix;?>[product_additional_images][]" />
					<a class="modal btn" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&asset=59&author=960&fieldid=jform_images_image_alt1&folder=" title="Select"> Select</a>
					<a class="btn hasTooltip" onclick="jInsertFieldValue('', 'jform_images_image_alt1'); return false; " href="#" title="" data-original-title="Clear">
					<i class="icon-remove"></i>
					</a>
					</div>
				</div>
			</div>
		</div>

		<div class="control-group">
			<div class="control-label">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_ALTER_IMAGE_2', array());?>
				<div class="controls">
					<div class="input-prepend input-append">
					<div class="media-preview add-on">
						<span class="hasTipPreview" title="">
						<i class="icon-eye"></i>
						</span>
					</div>
					<input id="jform_images_image_alt2" class="input" value="<?php echo $additional_image[1]; ?>" type="text"  readonly="readonly"  name="<?php echo $form_prefix;?>[product_additional_images][]">
					<a class="modal btn" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&asset=59&author=960&fieldid=jform_images_image_alt2&folder=" title="Select"> Select</a>
					<a class="btn hasTooltip" onclick=" jInsertFieldValue('', 'jform_images_image_alt2'); return false; " href="#" title="" data-original-title="Clear">
					<i class="icon-remove"></i>
					</a>
					</div>
				</div>
			</div>
		</div>

		<div class="control-group">
			<div class="control-label">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_ALTER_IMAGE_3', array());?>
			</div>
				<div class="controls">
					<div class="input-prepend input-append">
					<div class="media-preview add-on">
						<span class="hasTipPreview" title="">
						<i class="icon-eye"></i>
						</span>
					</div>
					<input id="jform_images_image_alt3" class="input" value="<?php echo $additional_image[2];?>" type="text"   readonly="readonly" name="<?php echo $form_prefix;?>[product_additional_images][]">
					<a class="modal btn" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&asset=59&author=960&fieldid=jform_images_image_alt3&folder=" title="Select"> Select</a>
					<a class="btn hasTooltip" onclick=" jInsertFieldValue('', 'jform_images_image_alt3'); return false; " href="#" title="" data-original-title="Clear">
					<i class="icon-remove"></i>
					</a>
					</div>
				</div>
		</div>

		<div class="control-group">
			<div class="control-label">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_ALTER_IMAGE_4', array());?>
			</div>
				<div class="controls">
					<div class="input-prepend input-append">
					<div class="media-preview add-on">
						<span class="hasTipPreview" title="">
						<i class="icon-eye"></i>
						</span>
					</div>
					<input id="jform_images_image_alt4" class="input" value="<?php echo $additional_image[3];?>" type="text" readonly="readonly" name="<?php echo $form_prefix;?>[product_additional_images][]">
					<a class="modal btn" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&asset=59&author=960&fieldid=jform_images_image_alt4&folder=" title="Select"> Select</a>
					<a class="btn hasTooltip" onclick=" jInsertFieldValue('', 'jform_images_image_alt4'); return false; " href="#" title="" data-original-title="Clear">
					<i class="icon-remove"></i>
					</a>
					</div>
				</div>
		</div>
	</div>
</div>
