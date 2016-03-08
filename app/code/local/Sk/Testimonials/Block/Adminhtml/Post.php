<?php
class Sk_Testimonials_Block_Adminhtml_Post extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'sk_testimonials';
        $this->_headerText = Mage::helper('sk_testimonials/post')->__('Testimonials Manager');
        parent::__construct();
        $this->_removeButton('add');
    }
}