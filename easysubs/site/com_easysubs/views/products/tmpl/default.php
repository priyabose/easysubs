<?php 
	/*
	 * 
	 * 
	 * 
	 */
	 
	// print_r($this->items);
	 $this->model=FOFModel::getTmpInstance('Products','EasysubsModel');
 ?>
<div class="row-fluid">
	<div class="span12">
		<?php foreach($this->items as $item): ?>
		<div class="thumbnail">
			<a href="<?php echo JRoute::_('index.php?option=com_easysubs&view=product&id='.$item->easysubs_product_id); ?>" ><?php echo $item->product_title;?></a>
			
			<?php echo JText::_('COM_EASYSUBS_PRODUCT_TITLE');?>			
			<?php
			$this->plans=$this->model->getPlans($item->easysubs_product_id);
			
				$options=array();
				$options[] =JHtml::_('select.option',  '0', JText::_('COM_EASYSUBS_SELECT'));
						foreach($this->plans as  $plan)
						{
							$options[] =JHtml::_('select.option',  $plan->easysubs_plan_id, JText::_($plan->plan_title));
						}
						echo JHtml::_('select.genericlist',$options, 'plan_id',null, 'value', 'text');?>
		 
		
		</div>
		<?php endforeach; ?>
	</div>
</div>
