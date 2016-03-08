<?php

class Sk_Testimonials_Block_Adminhtml_Post_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
        ));

        $fieldset = $form->addFieldset('sk_testimonials_form', array('legend' => Mage::helper('sk_testimonials')->__('Testimonial information')));

        $fieldset->addField('comment', 'textarea', array(
            'label' => Mage::helper('sk_testimonials')->__('Comment'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'comment',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('sk_testimonials')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'status',
            'value' => '0',
            'values' => array(
                '-1' => 'Please Select..',
                '0' => Mage::helper('sk_testimonials')->__('Not Active'),
                '1' => Mage::helper('sk_testimonials')->__('Active'),
            ),
            'disabled' => false,
            'readonly' => false,
            'after_element_html' => '<small>Set Status</small>',
            'tabindex' => 1
        ));


        if (Mage::getSingleton('adminhtml/session')->getsk_testimonialsData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getsk_testimonialsData());
            Mage::getSingleton('adminhtml/session')->setsk_testimonialsData(null);
        } elseif (Mage::registry('sk_testimonials_data')) {
            $form->setValues(Mage::registry('sk_testimonials_data')->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
