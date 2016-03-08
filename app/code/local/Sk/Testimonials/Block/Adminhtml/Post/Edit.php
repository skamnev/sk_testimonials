<?php
class Sk_Testimonials_Block_Adminhtml_Post_Edit extends Mage_Adminhtml_Block_Widget_Form_Container

{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sk_testimonials';
        $this->_controller = 'adminhtml_post';

        $this->_updateButton('save', 'label', Mage::helper('sk_testimonials')->__('Save Testimonial'));
        $this->_removeButton('reset');
    }

    public function getHeaderText()
    {
        return Mage::helper('sk_testimonials')->__("Edit Testimonial");
    }
}