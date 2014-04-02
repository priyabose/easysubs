<?php 



class EasysubsModelSubscribtions extends FOFModel{
	
	/*
	public function buildQuery($overrideLimits = false) {
		$app = JFactory::getApplication();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->getProductQuery($query);
		return $query;
	}
	
	protected function getProductQuery(&$query){
		$query->select('product.*');
		$query->from('#__easysubs_products as product');
		$query->leftjoin('#__easysubs_plans as plan ON product.easysubs_product_id=plan.product_id');
		$query->select("plan.easysubs_plan_id,plan.plan_title,plan.product_id,plan.invoice_name,plan.period,plan.period_unit,plan.free_quantity,plan.price,plan.plan_status");	
		}
	*/
	public function saveCustData($data){
		$db = JFactory::getDbo();
		
		$row=FOFTable::getAnInstance('Customer','EasysubsTable');
		
		if(!$row->bind($data)){
			return false;
		}
		
		if(!$row->check($data)){
			return false;
			}
		if(!$row->store()){
			return false;
			}
		return $row;
		}

}


