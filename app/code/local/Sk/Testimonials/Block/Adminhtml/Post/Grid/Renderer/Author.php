<?php
class Sk_Testimonials_Block_Adminhtml_Post_Grid_Renderer_Author
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $customer = Mage::getModel('customer/customer')->load($row->getData('user_id'));
        
        return $customer->getName();
    }
}