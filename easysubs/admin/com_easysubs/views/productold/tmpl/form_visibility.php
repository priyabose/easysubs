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

?>
<div class="row-fluid">
	<div class="span2">

	</div>
	<div class="span10">


		<!--control group for Product Created Date-->
		<div class="control-group">
			<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_AVAILABLE_FROM_DATE', array())?>
			<div class="controls">
				<?php echo JHtml::calendar($this->item->available_from_date, $form_prefix.'[available_from_date]', $form_prefix.'[available_from_date]');?>
			</div>
		</div>
		<div class="control-group">
				<?php echo FlycartInput::getLabel('COM_FLYCART_PRODUCT_AVAILABLE_TO_DATE', array())?>
				<!--  Calender for Avaiable product up to Date -->
			<div class="controls">
			<?php echo JHtml::calendar($this->item->available_to_date, $form_prefix.'[available_to_date]', $form_prefix.'[available_to_date]');?>
				</div>



			</div>

	</div>
</div>