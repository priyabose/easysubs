<?php 
 $this->model=FOFModel::getTmpInstance('Products','EasysubsModel');

?>
<div class="row-fluid">
	<div class="span12">
	<h3><?php echo JText::_('COM_EASYSUBS_PRODUCT');?><?php echo $this->item->product_title;?></h3>
	<?php 
	$this->plans=$this->model->getPlans($this->item->easysubs_product_id);
			/*
				$options=array();
				$options[] =JHtml::_('select.option',  '0', JText::_('COM_EASYSUBS_SELECT'));
						foreach($this->plans as  $plan)
						{
							$options[] =JHtml::_('select.option',  $plan->easysubs_plan_id, JText::_($plan->plan_title));
						}
						echo JHtml::_('select.genericlist',$options, 'plan_id',null, 'value', 'text');
		*/				
		?>
	<?php foreach($this->plans as  $plan):?>
		<form method="post" action="index.php" id="siteForm">
		<div class="well">
			<h5><?php  
			
					 
				echo $plan->plan_title;?></h5>
			

	<input type="submit" value="subscribe" class="btn btn-success"/>
	<input type="hidden" name="plan_id" value="<?php echo $plan->easysubs_plan_id;?>" />
	<input type="hidden" name="option" value="com_easysubs"/>
	<input type="hidden" name="view" value="products" />
	<input type="hidden" name="task" value="subscribe" />
	<input type="hidden" name="product_id" value="<?php echo $this->item->easysubs_product_id; ?>" />
	</div>
	</form>
	<?php endforeach;?>
	
	</div>
</div>

