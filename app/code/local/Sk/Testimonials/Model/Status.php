<?php

class Sk_Testimonials_Model_Status extends Mage_Core_Model_Abstract {
    /*
     * Set resource model
     */

    protected function _construct() {
        $this->_init('sk_testimonials/status');
    }

    public function getOptionArray() {
        return array(
            array('value' => 1, 'label' => Mage::helper('adminhtml')->__('Enabled')),
            array('value' => 2, 'label' => Mage::helper('adminhtml')->__('Disabled'))
        );
    }

}
