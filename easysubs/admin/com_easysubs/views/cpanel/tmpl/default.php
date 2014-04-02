<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// load tooltip behavior
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">

function ups(){
jQuery('#drop').slideUp(500);
jQuery('.box-widget-footer').hide();
}

function downs(){
	jQuery('#drop').slideDown(500);
	jQuery('.box-widget-footer').show();
}
</script>

<style type="text/css">
.box-widget {
	border-radius: 4px 4px 4px 4px;
	background-color: #FBFBFB;
	border: 1px solid #EBEBEB;
	height: auto;
	margin-bottom: 20px;
}

.box-widget-head {
	-moz-box-sizing: border-box;
	background-color: #F8F8F8;
	background-image: -moz-linear-gradient(center top, #F6F6F6, #F0F0F0);
	border-bottom: 1px solid #DCDCDC;
	font-size: 14px;
	height: 28px;
	padding: 3px 6px;
}

.box-widget-head .btn-group .btn {
	background: none repeat scroll 0 0 transparent;
	border: medium none;
	box-shadow: none;
}

.box-widget-body {
	-moz-box-sizing: border-box;
	color: #666666;
	padding: 10px;
}

.quickLinks {
	list-style: none outside none;
	margin: 0;
	padding: 0;
	text-align: center;
	margin-left:20px;
}

.quickLinks ul {

}

.quickLinks li {
	background-color: #F8F8F8;
	border-radius: 3px 3px 3px 3px;
	border: 1px solid #EBEBEB;
	display: inline-block;
	height: 75px;
	text-align: center;
}

.quickLinks li:hover { /*top-left top-right bottom-right bottom-left*/
	box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.05) inset;
}

.quickLinks li i {
	margin-top: 10px;
}



.fcicon-profile {
	background: #F8F8F8
		url('<?php echo JUri::root();?>/media/easysubs/store_profile.png')
		no-repeat right top;
	display: inline-block;
	
}

.plans {
	background: #F8F8F8
		url('<?php echo JUri::root();?>/media/easysubs/plans.png')
		no-repeat right top;
	display: inline-block;
	margin: 0px;
	margin-top: 5px;
	height: 65px;
	width: 65px;
	
}

.quickLinks li h6 {
	margin-top: 0px;
}

.box-widget-footer {
	-moz-box-sizing: border-box;
	border-top: 1px solid #F4F4F4;
	color: #999999;
	font-family: "OpenSansBold";
	font-size: 10px;
	margin-top: 8px;
	padding: 5px 10px;
} 
.customer{	
	background: #F8F8F8
		url('<?php echo JUri::root();?>/media/easysubs/images/customers.png')
		no-repeat right top;
	display: inline-block;
	height: 65px;
	width: 65px;
	
	
	}
</style>

<form
	action="<?php echo JRoute::_('index.php?option=com_easysubs&view=cpanel'); ?>"
	method="post" name="adminForm" id="adminForm">
	<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span12">
	<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else : 
		
	?>
		<div id="j-main-container">
		<?php endif;?>

			<div id="contents" class="row-fluid">
				<!-- Dashboard -->
				<div id="dashboard" class="span6">

					<!-- start quickicons list -->
					<div class="row-fluid">
									
								<div class="span3">
									<a	href="<?php echo JRoute::_('index.php?option=com_easysubs&view=subscriptions');?>">
										<img src="<?php echo JUri::root().'/media/easysubs/images/subscriptions.png'?>"/>
										<h7>
											<?php echo JText::_('COM_EASYSUBS_TITLE_SUBSCRIPTIONS');?>
										</h7>
										</a>
								</div>
								
								<div class="span3">
									<a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=produts');?>">
										<img src="<?php echo JUri::root().'/media/easysubs/images/customers.png'?>"/>
										<h7>
											<?php echo JText::_('COM_EASYSUBS_TITLE_CUSTOMERS');?>
										</h7>
								</a>
								</div>
								<div class="span2"><a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=reports');?>">
									<img src="<?php echo JUri::root().'/media/easysubs/images/options.png'?>"/>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_PLANS');?>
										</h7>
								</a>
								</div>
								<div class="span2"><a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=statuses');?>">
										<i class="fcicon-status"></i>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_STATUSES');?>
										</h7>
								</a>
								</div>
								<div class="span2">
									<a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=statuses');?>">
										<i class="fcicon-status"></i>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_STATUSES');?>
										</h7>
								</a>
								</div>
								<div class="span2"><a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=statuses');?>">
										<i class="fcicon-status"></i>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_STATUSES');?>
										</h7>
								</a>
								</div>
								<div class="span2">
									<a
									href="<?php echo JRoute::_('index.php?option=com_easysubs&view=statuses');?>">
										<i class="fcicon-status"></i>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_STATUSES');?>
										</h7>
								</a>
								</div>
								<div class="span2">
									<a href="<?php echo JRoute::_('index.php?option=com_easysubs&view=statuses');?>">
										<i class="fcicon-status"></i>
										<h7>
										<?php echo JText::_('COM_EASYSUBS_TITLE_STATUSES');?>
										</h7>
									</a>
								</div>
							</div>
						</div>
						<div class="box-widget-footer" style="display: block;"></div>
						<!-- quick icons list end -->
							
				<!--  End of dashboard -->
			</div>
			<!-- End of contents -->

			<!-- End of container -->

			<hr>
			<!-- Footer -->
			<footer>
				<div align="center">
					<p>Copyright &copy;Themeparrot . All Rights Reserved</p>
					<p><a href="http://themeparrot.com/">Themeparrot</a></p>
				</div>
			</footer>
		</div>
	</div>
</form>


