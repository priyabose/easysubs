<?php 

class EasysubsControllerProducts extends FOFController
{
	public function execute($task) {

		if(!in_array($task, array('subscribe'))) {
			//$task = 'browse';
		}

		parent::execute($task);
	}
	
	public function subscribe(){
		$app=JFactory::getApplication();
		$session=JFactory::getSession();
		$post=$_POST;
		
		$plan_id=$_POST['plan_id'];
		$product_id=$_POST['product_id'];
		$session->get('easysubs_plan');
		$session->set('easysubs_plan',$plan_id);		
		$session->get('easysubs_product');
		$session->set('easysubs_product',$product_id);
		//$url = JRoute::_('index.php?option=com_easysubs&view=subscription&product_id='.$product_id);
		$url="index.php?option=com_easysubs&view=subscribtions&product_id=".$product_id."&plan_id=".$plan_id;
		
		$this->setRedirect($url, $msg);
	}
	
}
