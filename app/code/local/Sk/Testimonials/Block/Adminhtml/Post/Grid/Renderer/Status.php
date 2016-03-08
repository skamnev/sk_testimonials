<?php
class Sk_Testimonials_Block_Adminhtml_Post_Grid_Renderer_Status
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ($row->getData('status')) {
            return Mage::helper('sk_testimonials')->__('Active');
        }
        
        return Mage::helper('sk_testimonials')->__('Not Active');
    }
}