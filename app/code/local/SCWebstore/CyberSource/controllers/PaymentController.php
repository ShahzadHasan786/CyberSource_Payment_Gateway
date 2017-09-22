<?php
/*
CyberSource Payment Controller
By: Shahzad Hasan
www.scwebstore.com
*/

class SCWebstore_CyberSource_PaymentController extends Mage_Core_Controller_Front_Action {
	
	// The redirect action is triggered when someone places an order
	public function redirectAction() {
		$this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','CyberSource',array('template' => 'cybersource/redirect.phtml'));
		$this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
	}
	
	// The response action is triggered when your gateway sends back a response after processing the customer's payment
	public function responseAction() {		
		
		if($this->getRequest()->isPost()) {
			
			/*
			/* Your gateway's code to make sure the reponse you
			/* just got is from the gateway and not from some weirdo.
			/* This generally has some checksum or other checks,
			/* and is provided by the gateway.
			/* For now, we assume that the gateway's response is valid
			*/
			
			$validated = true;
			$orderId = '100000001'; // Generally sent by gateway						
			
			if($validated) {								
				
				// Payment was successful, so update the order's state, send order email and move to the success page
				//$order = Mage::getModel('sales/order');
				//$order->loadByIncrementId($orderId);
				//$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Gateway has authorized the payment.');
				
				//$order->sendNewOrderEmail();
				//$order->setEmailSent(true);
				
				//$order->save();
			
				//Mage::getSingleton('checkout/session')->unsQuoteId();
				
				//Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array('_secure'=>true));
			}
			else {
				// There is a problem in the response we got
				//$this->cancelAction();
				Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', array('_secure'=>true));
			}
		}
		else
			Mage_Core_Controller_Varien_Action::_redirect('');
	}
	
	public function successAction() {
        $quote = Mage::getSingleton('checkout/session')->getQuote();
    	$quoteid = Mage::getSingleton('checkout/session')->getQuoteId();
    	$quote->assignCustomer(Mage::getSingleton('customer/session')->getCustomer());
    	$quote->collectTotals()->getPayment()->setMethod('cybersource');
    	$service = Mage::getModel('sales/service_quote', $quote);
    	$service->submitAll();
    	Mage::getSingleton('checkout/session')->setLastQuoteId($quote->getId())->setLastSuccessQuoteId($quote->getId())->clearHelperData();
    	$order = $service->getOrder();
    	if($order){
        	Mage::getSingleton('checkout/session')->setLastOrderId($order->getId())->setLastRealOrderId($order->getIncrementId());
    	}
    	$quote->setIsActive(false)->save();
    	$this->_redirect('checkout/onepage/success');
	}
	
	// The cancel action is triggered when an order is to be cancelled
	public function cancelAction() {
        /*if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            if($order->getId()) {
				// Flag the order as 'cancelled' and save it
				$order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Gateway has declined the payment.')->save();
			}
        }*/
		Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', array('_secure'=>true));
	}
}