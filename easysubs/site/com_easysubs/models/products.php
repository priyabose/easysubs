<?php 



class EasysubsModelProducts extends FOFModel{
	
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
	public function getPlans($product_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select("plan.easysubs_plan_id,plan.plan_title,plan.product_id,plan.invoice_name,plan.period,plan.period_unit,plan.free_quantity,plan.price,plan.plan_status");	
		$query->from("#__easysubs_plans as plan");
		$query->where("plan.product_id=".$product_id);
		$db->setQuery($query);
		$row=$db->loadObjectList();		
		if(!$row){
				$row= new JObject();
			
			}
		return $row;
		}

}


