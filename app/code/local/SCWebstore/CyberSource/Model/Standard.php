<?php
class SCWebstore_CyberSource_Model_Standard extends Mage_Payment_Model_Method_Abstract {
	protected $_code = 'cybersource';
	
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = true;
	protected $_canUseForMultishipping  = false;
	
	// we should use this function getCheckoutRedirectUrl() this will not create an order entity
	/*public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('cybersource/payment/redirect', array('_secure' => true));
	}*/
	
	public function getCheckoutRedirectUrl() {
		return Mage::getUrl('cybersource/payment/redirect', array('_secure' => true));
	}		
}
?>