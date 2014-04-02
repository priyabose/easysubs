<?php 
		$app=JFactory::getApplication();
		
?>
	<div class="row-fluid">
		<h4>You have Selected our <?php //echo $this->product_item->product_title ;?></h4>
		
		<form class="form-horizontal" method="post" action="index.php">
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_FIRST_NAME');?>
				</label>				
				<div class="controls">
					<input type="text" class="input" name="data[first_name]"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_LAST_NAME');?>
				</label>				
				<div class="controls">
					<input type="text" class="input" name="data[last_name]"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_EMAIL');?>
				</label>				
				<div class="controls">
					<input type="text" class="input" name="data[email_id]"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_PHONE');?>
				</label>				
				<div class="controls">
					<input type="text" class="input" name="data[phone]"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_COMPANY');?>
				</label>				
				<div class="controls">
					<input type="text" class="input" name="data[company]"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_AUTO_COLLECTION');?>
				</label>				
				
					<?php
						$val=array();
						//$options[] =JHtml::_('select.option',  '0', JText::_('COM_EASYSUBS_SELECT'));
						$val[]=JHtml::_('select.option' , 1 ,JText::_('COM_EASYSUBS_YES'));
						$val[]=JHtml::_('select.option' , 0 ,JText::_('COM_EASYSUBS_NO'));
						
						echo JHtml::_('select.radiolist',$val,'data[auto_collection]',null,'value','text',1); ?>
					
				
			</div>
			<div class="control-group">
			
			<?php 
				
				$countries=FOFModel::getTmpInstance('Countries', 'EasysubsModel');		
				print_r($countries);
			?>
			
			</div>
			<input type="submit" class="btn btn-success" value="subscribe"/>
			<input type="hidden" name="product_id" value="<?php echo $app->input->getInt('product_id');?>" />
			<input type="hidden" name="plan_id" value="<?php echo $app->input->getInt('plan_id');?>" />
			<input type="hidden" name="option" value="com_easysubs"/>
			<input type="hidden" name="view" value="subscribtions" />
			<input type="hidden" name="task" value="save_subscribe" />
			
			
		</form>
	</div>
