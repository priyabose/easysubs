<?php

/*------------------------------------------------------------------------
 # com_easysubs
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

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

	$action="index.php?option=com_easysubs&view=products";
	$listOrder = $this->escape($this->state->get('filter_order'));
	$listDirn = $this->escape($this->state->get('filter_order_Dir'));

	$ordering = ($listOrder == 'a.ordering');
	$saveOrder 	= ($listOrder == 'a.ordering' && strtolower($listDirn) == 'asc');
	$originalOrders = array();

	if ($saveOrder)
	{
		$saveOrderingUrl = 'index.php?option=com_orangecart&controller=orangecart.ordering.component.saveOrderAjax';
		JHtml::_('sortablelist.sortable', 'orangecartList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
	}

	$sortFields =$this->sortFields;


?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{

		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;

		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';

		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	};
</script>

<form  action="<?php $action; ?>" class="adminForm" name="adminForm" id="adminForm" method="post">
	<div class="row">
		<div class="span2">
		</div>
		<div class="span10">
			<div id="filter-bar" class="btn-toolbar">
				<div class="filter-search btn-group pull-left">
					<label class="element-invisible" for="title">
						<?php echo JText::_('COM_EASYSUBS_PRODUCT_NAME')?>
					</label>
					<input id="product_name" type="text" onchange="document.adminForm.submit();" placeholder="<?php echo JText::_('COM_EASYSUBS_PRODUCT_NAME')?>" value="" name="filter_search">
			</div>
			<div class="btn-group pull-left hidden-phone">
				<button class="btn hasTip hasTooltip" title="search" onclick="this.form.submit();" data-original-title="Search">
				<i class="icon-search"></i>
				</button>
				<button class="btn hasTip hasTooltip" title="Remove" onclick="document.adminForm.product_name.value='';this.form.submit();" data-original-title="Reset">
				<i class="icon-remove"></i>
				</button>
			</div>



			<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY');?></label>
						<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
							<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
							<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
						</select>

		</div>


		<div class="btn-group pull-right">
			<!-- lIMIT BOX -->
			<?php echo $this->limit_box;?>
		</div>

		<table  class="table table-striped">
		<thead>
			<tr>
		<!-- sortable icon class -->
			    <th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'ordering',$listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
				</th>

				<!-- check box -->
			    <th><?php echo JHtml::_('grid.checkall'); ?></th>


				<!--  Product Name -->
			    <th class="title">
			    	<?php echo JHtml::_('grid.sort', 'COM_EASYSUBS_PRODUCT_NAME','product_name',$listDirn, $listOrder); ?>
				</th>


				<th>
					<?php echo JHtml::_('grid.sort',  'COM_EASYSUBS_PRODUCT_PRICE', 'price'); ?>
				</th>

				<!-- state table heading -->
				<th>
					<?php echo JHtml::_('grid.sort',  'JENABLED', 'enabled'); ?>
				</th>
				</tr>
			</thead>
				<tfoot><tr><td colspan="6"><?php echo $this->pageList;?></td></tr></tfoot>

			<tbody>
			<?php foreach($this->items as $i =>$item):
			$canChange = 1;
			$canEdit = 1;

			?>
			<tr class="row<?php echo $i%2; ?>" >
			<td class="order nowrap center hidden-phone">
						<?php

							$iconClass = '';

							if (!$canChange)
								{
									$iconClass = ' inactive';
								}
								elseif (!$saveOrder)
								{
									$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
								}
						?>
						<span class="sortable-handler<?php echo $iconClass ?>">
							<i class="icon-menu"></i>
						</span>
						<?php if ($canChange && $saveOrder) : ?>
						<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="width-20 text-area-order " />
						<?php endif; ?>
					</td>
					  <td>
				    <?php echo JHtml::_('grid.id', $i, $item->flycart_product_id); ?>
				    </td>
				<td>
					<a href="<?php echo ($item->catalog_source =='com_content') ? JRoute::_('index.php?option=com_content&view=article&task=article.edit&id='.$item->catalog_source_id) : JRoute::_('index.php?option=com_easysubs&view=product&id='.$item->flycart_product_id)?>">
						<?php  echo $item->title?>
					</a>
				</td>

				<td>
					<?php echo $item->price;?>
				</td>
				<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->enabled, $i, 'flycart.publish.component.', $canChange);?>
					</td>
			</tr>
			<?php endforeach;?>
			</tbody>
		</table>

</div>
	<input type="hidden" value="com_easysubs" name="option">
	<input type="hidden" value="products" name="view">
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" value="browse" name="task">
	<input type="hidden" value="id" name="filter_order">
	<input type="hidden" value="DESC" name="filter_order_Dir">
	<?php echo JHtml::_('form.token'); ?>
</form>
