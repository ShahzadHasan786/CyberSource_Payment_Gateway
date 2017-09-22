<?php

/**
 * @category   SCWebstore
 * @package    SCWebstore_Cybersource
 * @author     Shahzad Hasan
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class SCWebstore_CyberSource_Model_System_Config_Source_Modes
{
    public function toOptionArray()
    {
        return array(
            0 => Mage::helper('cybersource')->__('Test'),
            1 => Mage::helper('cybersource')->__('Live'),
        );
    }
	
	public function toArray()
    {
        return array(
            0 => Mage::helper('cybersource')->__('Test'),
            1 => Mage::helper('cybersource')->__('Live'),
        );
    }
}