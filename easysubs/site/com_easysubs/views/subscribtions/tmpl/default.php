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
					<?php echo JText::_('COM_EASYSUBS_COUNTRY');?>
				</label>
			<div class="controls">
			<?php 
				$countries=FOFModel::getTmpInstance('Countries', 'EasysubsModel')->enabled(1)->getList(true);
				
				foreach($countries as $country){
						$coun[]=JHtml::_('select.option' , $country->easysubs_country_id ,JText::_($country->country_name));
					}
					$c_attr=array('onchange'=>'getZones(this.value)','id'=>'country_id');
				 echo JHtml::_('select.genericlist',$coun,'data[country_id]',$c_attr,'value','text'); ?>
			</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					<?php echo JText::_('COM_EASYSUBS_ZONE');?>
				</label>
				<span id="zone_id"></span>
					<div class="controls">
						<select id="datazone_id" name="data[zone_id]">
						</select>
					</div>
				</div>
			<input type="submit" class="btn btn-success" value="subscribe"/>
			<input type="hidden" name="product_id" value="<?php echo $app->input->getInt('product_id');?>" />
			<input type="hidden" name="plan_id" value="<?php echo $app->input->getInt('plan_id');?>" />
			<input type="hidden" name="option" value="com_easysubs"/>
			<input type="hidden" name="view" value="subscribtions" />
			<input type="hidden" id="task" name="task" value="saveSubscribe" />
			
			
		</form>
	</div>
<script type="text/javascript">
	
	jQuery(document).ready(function(){
		
		getZones(country_id=1);
		});
	function getZones(country_id){
			
		jQuery.ajax({
			url :'index.php?option=com_easysubs&view=subscribtions&task=getZones&country_id='+country_id,						
			dataType: 'json',
			
		success: function(json) {
		
			
		
			html = '<option value=""><?php echo JText::_('COM_EASYSUBS_SELECT'); ?></option>';

			
			if (json['zone'] != '') {
				
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['easysubs_zone_id'] + '"';
					

	    			html += '>' + json['zone'][i]['zone_name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo JText::_('J2STORE_CHECKOUT_NONE'); ?></option>';
			} 
			
			jQuery('#datazone_id').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
		} 
		})
	
}
</script>
