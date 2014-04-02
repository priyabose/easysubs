<?php

defined('_JEXEC') or die;
?>
<script type="text/javascript">

(function($) {

		$(document).on( 'change', "#flycart_country_id", function() {
		//$("#flycart_country_id").bind('change load', function(){

			var zone_id;
			<?php if(isset($this->item->zone_id)) { ?>
			zone_id = <?php echo $bzone_id=($this->item->zone_id)?$this->item->zone_id:0; ?>;
			<?php } else { ?>
			zone_id=0;
			<?php } ?>

				var country_id = $('#flycart_country_id').val();
				var field_name = 'zone_id';
				var field_id = 'flycart_zone_id';

				if($('#flycart_country_id')) {
					flycartGetAjaxZones(country_id, zone_id, field_id, field_name);
				}
		 });

	})(flycart.jQuery);

	(function($) {
	$('#flycart_country_id').trigger('change');
	})(flycart.jQuery);


</script>
<div class="flycart_store_edit">
<?php
$viewTemplate = $this->getRenderedForm();
echo $viewTemplate;
?>
</div>
