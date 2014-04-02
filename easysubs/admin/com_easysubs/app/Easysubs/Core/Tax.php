<?php
/**
*  @package     Easysubs
*  @subpackage	 Core
*  @copyright   Copyright (c)2013-2018 Ramesh Elamathi
*  @license     GNU General Public License version 2, or later
*/
defined('_JEXEC') or die;

class EasySubsTax extends EasysubsCore {

	protected static $flyinstance;
	private $shipping_address;
	private $billing_address;
	private $store_address;
	private $session_data;

	public function __construct($args = array()) {

		$app=JFactory::getApplication();

		$session=JFactory::getSession();

		if ($session->has('shipping_country_id', 'flycart') || $session->has('shipping_zone_id', 'flycart')) {
			$this->setShippingAddress($session->get('shipping_country_id', '', 'flycart'), $session->get('shipping_zone_id', '', 'flycart'));
		} elseif (Easysubs::config('store_tax_default') == 'shipping') {
			$this->setShippingAddress(Easysubs::config('country_id'), Easysubs::config('zone_id'));
		}

		if ($session->has('billing_country_id', 'flycart') || $session->has('billing_zone_id', 'flycart')) {
			$this->setBillingAddress($session->get('billing_country_id', '', 'flycart'), $session->get('billing_zone_id', '', 'flycart'));
		} elseif (Easysubs::config('store_tax_default') == 'billing') {
			 $this->setBillingAddress(Easysubs::config('country_id'), Easysubs::config('zone_id'));
		}

		// intialize session data with store's country and zone ids
		$this->setStoreAddress(Easysubs::config('country_id'), Easysubs::config('zone_id'));

	}

	public static function getFlyInstance($args=array())
	{
		if (!is_object(self::$flyinstance))
		{
			self::$flyinstance = new self($args);
		}

		return self::$flyinstance;
	}

	/**
	 * Method to calculate tax based on the taxclass
	 * @param float type $value
	 * @param int type $taxclass_id
	 * @param boolean type $calculate
	 * @return float type  $value
	 */
	public function calculate($value,$taxclass_id,$calculate=true)
	{

		if($taxclass_id && $calculate)
		{
			$amount= $this->getTax($value,$taxclass_id);

			return $amount;
		}else{

			return $value;

		}
	}

	/**
	 * Method to get TaxClassId
	 * @param unknown_type $product_id
	 * @return $taxclass;
	 */
	public static function getTaxClassId($product_id){
		$row = FOFModel::getTmpInstance('Products' , 'EasysubsModel')->getItem($product_id);
		return $row->taxclass;
	}

	/**
	 * Method to get the tax
	 * @param float $value
	 * @param int $taxclass_id
	 * @return calculated tax
	 */

	public function getTax($value,$taxclass_id)
	{
		$amount=0;
		$rates=$this->getRates($taxclass_id);

		$tax_rates=$this->getTaxRates($value, $rates);



		foreach($tax_rates as $tax_rate)
		{
			$amount +=$tax_rate['amount'];
		}
		return $amount;
	}

	public function getRateArray($value, $taxprofile_id) {

		$rates = $this->getRates($taxprofile_id);

		$tax_rates = $this->getTaxRates($value, $rates);

		return $tax_rates;
	}


	/**
	 * Method to set Store Address
	 * @param int $country_id
	 * @param int $zone_id
	 *
	 */

	public function setStoreAddress($country_id, $zone_id) {
		$this->store_address = array(
				'country_id' => $country_id,
				'zone_id'    => $zone_id
		);

	}

	/**
	 * Method to get Rates
	 * @param int type $taxclass_id
	 */
	public function getRates($taxclass_id)
	{
		$tax_rates=array();

		 if ($this->shipping_address) {

		 	$tax_query = "SELECT tr2.flycart_taxrate_id, tr2.taxrate_name AS name, tr2.taxrate_rate AS rate FROM "
			. " #__flycart_taxrules AS tr1 LEFT JOIN "
			. " #__flycart_taxrates AS tr2 ON (tr1.taxrate_id = tr2.flycart_taxrate_id) LEFT JOIN "
			. " #__flycart_geozonerules AS z2gz ON (tr2.geozone_id = z2gz.geozone_id) LEFT JOIN "
			. " #__flycart_geozones AS gz ON (tr2.geozone_id = gz.flycart_geozone_id) WHERE tr1.taxclass_id = ". (int)$taxclass_id
			. " AND tr1.address = 'shipping' "
			. " AND z2gz.country_id = ". (int)$this->shipping_address['country_id']
			. " AND (z2gz.zone_id = 0 OR z2gz.zone_id = " . (int)$this->shipping_address['zone_id']
			. ") ORDER BY tr1.ordering ASC";


			$taxrates_items = $this->executeQuery($tax_query);

			if(isset($taxrates_items)){
				foreach ($taxrates_items as $trate) {
					$tax_rates[$trate->flycart_taxrate_id] = array(
							'taxrate_id' => $trate->flycart_taxrate_id,
							'name'        => $trate->name,
							'rate'        => $trate->rate
					);
				}
			}
		}

		if ($this->billing_address) {

			$tax_query = "SELECT tr2.flycart_taxrate_id, tr2.taxrate_name AS name, tr2.taxrate_rate AS rate FROM  #__flycart_taxrules AS tr1"
			. " LEFT JOIN #__flycart_taxrates AS tr2 ON (tr1.taxrate_id = tr2.flycart_taxrate_id) LEFT JOIN "
			. " #__flycart_geozonerules AS z2gz ON (tr2.geozone_id = z2gz.geozone_id) LEFT JOIN "
			. " #__flycart_geozones AS  gz ON (tr2.geozone_id = gz.flycart_geozone_id) WHERE tr1.taxclass_id = ". (int)$taxclass_id
			. " AND tr1.address = 'billing' "
			. " AND z2gz.country_id = ". (int)$this->billing_address['country_id']
			. " AND (z2gz.zone_id = 0 OR z2gz.zone_id = " . (int)$this->billing_address['zone_id']
			. ") ORDER BY tr1.ordering ASC";

			$taxrates_items = $this->executeQuery($tax_query);


			if(isset($taxrates_items)){
				foreach ($taxrates_items as $trate) {
					$tax_rates[$trate->flycart_taxrate_id] = array(
							'taxrate_id' => $trate->flycart_taxrate_id,
							'name'        => $trate->name,
							'rate'        => $trate->rate
					);
				}
			}
		}

		if ($this->store_address) {
			$tax_query = "SELECT tr2.flycart_taxrate_id, tr2.taxrate_name AS name, tr2.taxrate_rate AS rate FROM "
			. " #__flycart_taxrules AS tr1 LEFT JOIN "
			. " #__flycart_taxrates AS tr2 ON (tr1.taxrate_id = tr2.flycart_taxrate_id) LEFT JOIN "
			. " #__flycart_geozonerules AS  z2gz ON (tr2.geozone_id = z2gz.geozone_id) LEFT JOIN "
			. " #__flycart_geozones AS gz ON (tr2.geozone_id = gz.flycart_geozone_id) WHERE tr1.taxclass_id = " . (int)$taxclass_id
			. " AND tr1.address = 'store' "
			. " AND z2gz.country_id = " . (int)$this->store_address['country_id']
			. " AND (z2gz.zone_id = 0 OR z2gz.zone_id = " . (int)$this->store_address['zone_id']
			. ") ORDER BY tr1.ordering ASC";


			$taxrates_items = $this->executeQuery($tax_query);

			if(isset($taxrates_items)){

				foreach ($taxrates_items as $trate) {
					$tax_rates[$trate->flycart_taxrate_id] = array(
							'taxrate_id' => $trate->flycart_taxrate_id,
							'name'        => $trate->name,
							'rate'        => $trate->rate
					);
				}
			}
		}

		return $tax_rates;
	}

	/**
	 * Method to get Taxrates
	 * @param unknown_type $value
	 * @param unknown_type $tax_rates
	 */
	public function getTaxRates($value, $tax_rates)
	{
		$tax_rate_data = array();

		foreach ($tax_rates as $tax_rate) {
			if (isset($tax_rate_data[$tax_rate['taxrate_id']])) {
				$amount = $tax_rate_data[$tax_rate['taxrate_id']]['amount'];
			} else {
				$amount = 0;
			}

			$amount += ($value / 100 * $tax_rate['rate']);

			$tax_rate_data[$tax_rate['taxrate_id']] = array(
					'taxrate_id' => $tax_rate['taxrate_id'],
					'name'        => $tax_rate['name'],
					'rate'        => $tax_rate['rate'],
					'amount'      => $amount
			);
		}


		return $tax_rate_data;

	}

	public function has($taxclass_id) {
		return isset($this->taxes[$taxclass_id]);
	}

	private function executeQuery($query){

		$db = JFactory::getDbo();
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public function setTaxProperties($type, $country_id, $zone_id) {

		$address_values = array();
		$address_values['country_id'] = $country_id;
		$address_values['zone_id'] = $zone_id;
		$this->setAddressInSession($address_values,$type,true);
	}

	public static function setAddressInSession($address_values, $type, $override=false){

		$session = JFactory::getSession();
		if($override==true ) {
			$session->set($type.'_country_id', $address_values['country_id'], 'j2store');
			$session->set($type.'_zone_id', $address_values['zone_id'], 'j2store');
		}
	}
	public function setShippingAddress($country_id, $zone_id) {
		$this->shipping_address = array(
				'country_id' => $country_id,
				'zone_id'    => $zone_id
		);
	}

	public function setBillingAddress($country_id, $zone_id) {
		$this->billing_address = array(
				'country_id' => $country_id,
				'zone_id'    => $zone_id
		);
	}

}
