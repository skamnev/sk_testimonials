<?php

class Sk_Testimonials_Adminhtml_PostController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('sk_testimonials/post')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Testimonials Manager'), Mage::helper('adminhtml')->__('Testimonials Manager'));
        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    public function editAction() {
        $sk_testimonialsId = $this->getRequest()->getParam('id');
        $sk_testimonialsModel = Mage::getModel('sk_testimonials/post')->load($sk_testimonialsId);

        if ($sk_testimonialsModel->getId() || $sk_testimonialsId == 0) {

            Mage::register('sk_testimonials_data', $sk_testimonialsModel);

            $this->loadLayout();
            $this->_setActiveMenu('sk_testimonials/post');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sk_testimonials/adminhtml_post_edit'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sk_testimonials')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        $sk_testimonialsId = $this->getRequest()->getParam('id');
        $sk_testimonialsModel = Mage::getModel('sk_testimonials/post')->load($sk_testimonialsId);

        if ($sk_testimonialsModel->getId() || $sk_testimonialsId == 0) {

            $sk_testimonialsModel->setComment($this->getRequest()->getParam('comment'));
            $sk_testimonialsModel->setStatus($this->getRequest()->getParam('status'));

            $sk_testimonialsModel->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sk_testimonials')->__('Your testimonial was added for review'));
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sk_testimonials')->__('Item does not exist'));
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        try {
            $this->_delete($this->getRequest()->getParam('id'));
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sk_testimonials')->__('Testimonial was deleted successfully'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        // get all entity_ids from post
        $params = $this->getRequest()->getParams()['entity_id'];

        //delete each post
        foreach ($params as $id) {
            $this->_delete($id);
            try {
                $this->_delete($id);
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/');
            }
        }

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));

        $this->_redirect('*/*/');
    }

    private function _delete($id) {
        if ($id > 0) {
            $model = Mage::getModel('sk_testimonials/post');

            $model->setId($id)
                    ->delete();
        }

        return true;
    }
}
