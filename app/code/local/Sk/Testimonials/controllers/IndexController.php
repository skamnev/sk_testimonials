<?php

class Sk_Testimonials_IndexController extends Mage_Core_Controller_Front_Action {
    public function preDispatch() {
        parent::preDispatch();
    }

    public function indexAction() {
        //get current layout stage
        $this->loadLayout();
        $this->getLayout()->getBlock('sk_testimonials_form_add')
            ->setFormAction( Mage::getUrl('*/*/add', array('_secure' => $this->getRequest()->isSecure())) );

        $this->_initLayoutMessages('customer/session');
        $this->renderLayout();
    }
    
    public function addAction()
    {
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return;
        }
        
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;
                
                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
                
                $customer = Mage::getSingleton('customer/session');

                $post = Mage::getModel('sk_testimonials/post');
                $post->setComment($this->getRequest()->getParam('comment'));
                $post->setStatus(false);
                $post->setUserId($customer->getId());
                $post->save();

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('sk_testimonials')->__('Your testimonial was added for review'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                
                Mage::getSingleton('customer/session')->addError(Mage::helper('sk_testimonials')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }
}