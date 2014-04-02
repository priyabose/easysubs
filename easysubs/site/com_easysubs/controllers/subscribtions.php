<?php 

class EasysubsControllerSubscribtions extends FOFController
{
	public function execute($task) {

		if(!in_array($task, array('save','save_subscribe'))) {
			//$task = 'browse';
		}

		parent::execute($task);
	}
	
	public  function save(){
		
		return parent::save();
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
		
		$url = JRoute::_('index.php?option=com_easysubs&view=subscribtion&id='.$product_id.'&plan_id='.$plan_id);
		
		$this->setRedirect($url, $msg);
	
		}
		
	public function saveSubscribe(){
			
		
		$app=JFactory::getApplication();
		$session=JFactory::getSession();
		$customer=FOFModel::getTmpInstance('customers','EasysubsModel');
		
		$this->customers=$customer->getItemList();
		
		$sub_model=FOFModel::getTmpInstance('Subscribtions','EasysubsModel');
		
		$this->subscibtions=$sub_model->getItemList();
		
		$post=$_POST;

		
		$data=$_POST['data'];
		$plan_id=$data['plan_id']=$_POST['plan_id'];
		$product_id=$data['product_id']=$_POST['product_id'];
			
		$customer_status;
		foreach($this->customers as $customer){
					
			if($customer->email_id == $data['email_id']){							
						$customer_status=$data;					
					}
			}
							
		if($customer_status){	
			
			$this->msg="Already Product Subscribed by You";
							
			$url ='index.php?option=com_easysubs&view=product&id='.$product_id;
		
			$this->setRedirect($url, $this->msg);
			
			//$app->close();
					
		} else{
		
		// first check already this customer subscribed this product
		
		
		
				
		
		$row=$sub_model->saveCustData($data);
		
		$data['customer_id']=$row->easysubs_customer_id;
		$data['created_at']=time();
		$data['started_at']=time();
		$data['activated_at']=time();
		$data['current_term_start']=time();
		$data['plan_quantity']=1;
		$data['status']=1;
			
		$sub_model->save($data);
		
		
		$msg= " Subscription Activated";
		$url ='index.php?option=com_easysubs&view=products';
		$this->setRedirect($url, $msg);
		}
	}
	
	public function getZones(){
		$app=JFactory::getApplication();
		
		$country_id=$app->input->getInt('country_id');	
		
		//$country_id=$_POST['data']['country_id'];
		$db=JFactory::getDbo();
		$query=$db->getQuery(true);
		$query
			->select("*")
			->from('#__easysubs_zones')
			->where('country_id='.$db->q($country_id));
			
		$db->setQuery($query);
		
		$zones=$db->loadObjectList();
		
		$json=array();
		
		foreach($zones as $i=>$zone){
			
			$json['zone'][$i]['easysubs_zone_id'] = $zone->easysubs_zone_id;
			
			$json['zone'][$i]['zone_name'] = $zone->zone_name;
					
		}
	
		echo json_encode($json);
		$app->close();
		
		}
	
}
